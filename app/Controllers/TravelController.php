<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PlanModel;
use App\Models\ConfirmationModel;
use App\Models\PlanUserModel;
use App\Models\UserModel;

class TravelController extends ResourceController
{

    public function getPlans()
    {
        $planModel = new PlanModel();
        $planUserModel = new PlanUserModel();
        $userModel = new UserModel();
        $userId = session()->get('id');
        
        // Get user's own plans
        $plans = $planModel->where('user_id', $userId)->findAll();
        
        // Add shared users info to plans
        foreach ($plans as &$plan) {
            $sharedUsers = $planUserModel->where('plan_id', $plan['id'])->findAll();
            $plan['shared_users'] = [];
            foreach ($sharedUsers as $sharedUser) {
                $user = $userModel->find($sharedUser['user_id']);
                if ($user) {
                    $plan['shared_users'][] = $user['email'];
                }
            }
        }

        // Get plans shared with the user
        $sharedPlans = $planUserModel
            ->select('plans.*, plan_users.is_owner')
            ->join('plans', 'plans.id = plan_users.plan_id')
            ->where('plan_users.user_id', $userId)
            ->where('plans.user_id !=', $userId)
            ->findAll();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'plans' => $plans,
                'sharedPlans' => $sharedPlans
            ]);
        }
        
        return view('plans/index', [
            'plans' => $plans,
            'sharedPlans' => $sharedPlans
        ]);
    }

    // Create a new travel plan
    public function createPlan()
    {
        log_message('debug', 'User ID from session: ' . session()->get('id'));

        $planModel = new PlanModel();
        $planUserModel = new PlanUserModel();
        
        $rules = [
            'destination' => 'required|min_length[3]',
            'start_date' => 'required|valid_date',
            'end_date' => 'required|valid_date',
            'activities' => 'required|min_length[3]',
            'title' => 'required|min_length[3]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['error' => $this->validator->getErrors()])->setStatusCode(400);
        }

        $data = [
            'destination' => $this->request->getVar('destination'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'activities' => $this->request->getVar('activities'),
            'title' => $this->request->getVar('title'),
            'user_id' => session()->get('id') // Associate plan with logged in user
        ];

        try {
            // Start transaction
            $db = \Config\Database::connect();
            $db->transStart();
    
            // Insert into plans table
            $planId = $planModel->insert($data);
            $data['id'] = $planId;
    
            // Insert into plan_users table
            $planUserModel->insert([
                'plan_id' => $planId,
                'user_id' => session()->get('id'),
                'is_owner' => 1
            ]);
    
            // Complete transaction
            $db->transComplete();
    
            if ($db->transStatus() === false) {
                // Something went wrong
                return redirect()->to('/plans')->with('error', 'Failed to create plan');
            }
    
            return redirect()->to('/plans')->with('success', 'Plan created successfully');
        } catch (\Exception $e) {
            log_message('error', 'Create plan error: ' . $e->getMessage());
            return redirect()->to('/plans')->with('error', 'Failed to create plan');
        }
    }

    // Add confirmation to a plan
    public function addConfirmation($planId)
    {
        try {
            // Enable error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            $confirmationModel = new ConfirmationModel();
            $planModel = new PlanModel();

            // Debug logging
            log_message('debug', 'Request data: ' . json_encode($this->request->getJSON()));
            
            // Verify plan ownership
            $plan = $planModel->where([
                'id' => $planId,
                'user_id' => session()->get('id')
            ])->first();
            
            if (!$plan) {
                log_message('error', 'Plan not found or unauthorized');
                return $this->failNotFound('Plan not found or unauthorized');
            }

            // Get JSON data
            $input = $this->request->getJSON(true);
            if (empty($input)) {
                log_message('error', 'Empty input data');
                return $this->fail('Empty input data');
            }

            $data = [
                'plan_id' => $planId,
                'type' => $input['type'] ?? null,
                'provider' => $input['provider'] ?? null,
                'booking_reference' => $input['booking_reference'] ?? null,
                'date' => $input['date'] ?? null,
                'time' => $input['time'] ?? null,
                'details' => $input['details'] ?? null
            ];

            // Validate required fields
            foreach ($data as $key => $value) {
                if ($value === null) {
                    log_message('error', "Missing required field: $key");
                    return $this->fail("Missing required field: $key");
                }
            }

            $insertId = $confirmationModel->insert($data);
            
            if (!$insertId) {
                log_message('error', 'Database insert failed: ' . json_encode($confirmationModel->errors()));
                return $this->fail('Failed to save confirmation');
            }

            return $this->respond([
                'status' => 200,
                'message' => 'Confirmation added successfully',
                'data' => array_merge($data, ['id' => $insertId])
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Add confirmation error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            return $this->fail($e->getMessage());
        }
    }

    // Get plan with all confirmations
    public function getPlan($planId)
    {
        $planModel = new PlanModel();
        $planUserModel = new PlanUserModel();
        $confirmationModel = new ConfirmationModel();

        // Check if user owns or has access to plan
        $plan = $planModel->where('id', $planId)->first();
        if (!$plan) {
            return redirect()->to('/plans')->with('error', 'Plan not found');
        }

        $hasAccess = $plan['user_id'] == session()->get('id') || 
                    $planUserModel->where(['plan_id' => $planId, 'user_id' => session()->get('id')])->first();
        
        if (!$hasAccess) {
            return redirect()->to('/plans')->with('error', 'Unauthorized access');
        }

        $plan['is_owner'] = ($plan['user_id'] == session()->get('id')); 

        $sharedUsers = $planUserModel
            ->select('users.email')
            ->join('users', 'users.id = plan_users.user_id')
            ->where('plan_id', $planId)
            ->where('plan_users.user_id !=', $plan['user_id']) // Exclude the owner
            ->findAll();

        $plan['shared_users'] = array_column($sharedUsers, 'email');

        $confirmations = $confirmationModel->where('plan_id', $planId)
            ->orderBy('date', 'ASC')
            ->orderBy('time', 'ASC')
            ->findAll();

        return view('plans/details', [
            'plan' => $plan,
            'confirmations' => $confirmations
        ]);
    }

    public function addUserToPlan($planId)
    {
        try {
            $planModel = new PlanModel();
            $plan = $planModel->where([
                'id' => $planId,
                'user_id' => session()->get('id')
            ])->first();
            
            if (!$plan) {
                return $this->failUnauthorized('Not authorized to modify this plan');
            }

            $input = $this->request->getJSON();
            $email = $input->email ?? null;
            if (!$email) {
                return $this->fail('Email is required');
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();
            
            if (!$user) {
                return $this->fail('User not found');
            }

            if ($user['id'] === session()->get('id')) {
                return $this->fail('Cannot add yourself to the plan');
            }

            $planUserModel = new PlanUserModel();
            $exists = $planUserModel->where([
                'plan_id' => $planId,
                'user_id' => $user['id']
            ])->first();

            if ($exists) {
                return $this->fail('User already added to this plan');
            }

            $planUserModel->insert([
                'plan_id' => $planId,
                'user_id' => $user['id'],
                'is_owner' => false
            ]);

            return $this->respondCreated(['message' => 'User added successfully']);

        } catch (\Exception $e) {
            log_message('error', 'Add user to plan error: ' . $e->getMessage());
            return $this->fail($e->getMessage());
        }
    }

    public function removeUserFromPlan($planId, $userEmail)
    {
        try {
            log_message('debug', print_r(['planId' => $planId, 'userEmail' => $userEmail], true));
            log_message('debug', "Attempting to remove user: $userEmail from plan: $planId");
            $planModel = new PlanModel();
            $plan = $planModel->find($planId);
            if (!$plan || $plan['user_id'] !== session()->get('id')) {
                return redirect()->to('/plans')->with('error', 'You are not authorized to modify this plan.');
            }

            $userModel = new UserModel();
            $user = $userModel->where('email', $userEmail)->first();
            
            if (!$user) {
                log_message('error', "User not found with email: $userEmail");
                return $this->fail('User not found');
            }

            $planUserModel = new PlanUserModel();
            $planUser = $planUserModel->where([
                'plan_id' => $planId,
                'user_id' => $user['id']
            ])->first();

            if (!$planUser) {
                log_message('error', "User $userEmail is not part of plan $planId");
                return $this->fail('User is not part of this plan');
            }

            $planUserModel->delete($planUser['id']);
            return redirect()->to('/plans/edit/' . $planId)->with('success', 'User removed successfully');

        } catch (\Exception $e) {
            log_message('error', 'Remove user from plan error: ' . $e->getMessage());
            return $this->fail($e->getMessage());
        }
    }

    public function updatePlan($planId)
    {
        try {
            $planModel = new PlanModel();
            $plan = $planModel->where([
                'id' => $planId,
                'user_id' => session()->get('id')
            ])->first();
            
            if (!$plan) {
                return $this->failUnauthorized('Not authorized to modify this plan');
            }

            $rules = [
                'destination' => 'required|min_length[3]',
                'activities' => 'required|min_length[3]'
            ];

            if (!$this->validate($rules)) {
                return $this->fail($this->validator->getErrors());
            }

            // Get JSON input
            $input = $this->request->getJSON();
            if (empty($input)) {
                return $this->fail('No data provided');
            }

            $data = [
                'destination' => $input->destination,
                'activities' => $input->activities
            ];

             // Validate required fields
            foreach ($data as $key => $value) {
                if ($value === null || trim($value) === '') {
                    return $this->fail("$key is required");
                }
            }

            if (empty($data['destination']) || empty($data['activities'])) {
                return $this->fail('Destination and activities are required');
            }

            $planModel->update($planId, $data);
            return $this->respond([
                'status' => 200,
                'message' => 'Plan updated successfully'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Update plan error: ' . $e->getMessage());
            return $this->fail($e->getMessage());
        }
    }

    public function editPlan($planId)
    {
        $planModel = new PlanModel();
        $planUserModel = new PlanUserModel();
        $userModel = new UserModel();

        $plan = $planModel->where([
            'id' => $planId,
            'user_id' => session()->get('id')
        ])->first();
    
        if (!$plan) {
            return redirect()->to('/plans')->with('error', 'Plan not found');
        }

        // Get only shared users (excluding owner)
        $sharedUsers = $planUserModel
        ->where('plan_id', $planId)
        ->where('is_owner', 0)
        ->findAll();

        $plan['shared_users'] = [];
        foreach ($sharedUsers as $sharedUser) {
            $user = $userModel->find($sharedUser['user_id']);
            if ($user) {
                $plan['shared_users'][] = $user['email'];
            }
        }

        return view('plans/edit', [
            'plan' => $plan
        ]);
    }

   public function deletePlan($planId)
    {
        try {
            // Initialize models
            $planModel = new PlanModel();
            $planUserModel = new PlanUserModel();

            // Check if the plan exists and if the user is the owner
            $plan = $planModel->where([
                'id' => $planId,
                'user_id' => session()->get('id') // Only allow the owner to delete the plan
            ])->first();

            if (!$plan) {
                return redirect()->to('/plans')->with('error', 'You are not authorized to delete this plan or the plan does not exist.');
            }

            // Delete related plan_users entries to remove all shared users from the plan
            $planUserModel->where('plan_id', $planId)->delete();

            // Delete the plan
            if ($planModel->delete($planId)) {
                // Redirect with success message
                return redirect()->to('/plans')->with('success', 'Plan deleted successfully.');
            } else {
                // If deletion failed
                return redirect()->to('/plans')->with('error', 'Failed to delete the plan.');
            }

        } catch (\Exception $e) {
            // Log the error
            log_message('error', 'Delete plan error: ' . $e->getMessage());
            return redirect()->to('/plans')->with('error', 'An error occurred while deleting the plan.');
        }
    }

}