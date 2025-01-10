<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
  
class Dashboard extends Controller
{
    public function index()
    {
        $session = session();
        
        // Simple session check is enough since we have authGuard filter
        if (!$session->get('isLoggedIn')) {
            return view('layouts/mainnotsignedin');
        } else {
            return view('layouts/main', [
                'user_name' => $session->get('name')
            ]);
        }
    }
}