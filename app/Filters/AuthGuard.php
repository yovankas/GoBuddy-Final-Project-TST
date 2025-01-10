<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $currentPath = $request->getPath(); // Using proper method to get path
        
        // List of public routes that don't need authentication
        $publicRoutes = ['', 'signin', 'signup', 'logout'];
        
        // If not logged in and trying to access protected route
        if (!$session->get('isLoggedIn')) {
            // Redirect to signin for protected routes
            if (!in_array($currentPath, $publicRoutes)) {
                return redirect()->to('/signin');
            }
            // Allow access to public routes
            return ;
        }
        
        // If logged in and trying to access auth pages (signin/signup)
        if (in_array($currentPath, ['signin', 'signup'])) {
            return redirect()->to('/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}