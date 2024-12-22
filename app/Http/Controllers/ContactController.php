<?php
namespace App\Http\Controllers; //path
use Illuminate\Http\Request;  
	class ContactController extends Controller
{	// Show the contact form
   		 public function show()
    	{
        return view('contactController');
    }  
    public function index()
    {
        return view('contact'); // सुनिश्चित करें कि यह `resources/views/contact.blade.php` फाइल मौजूद है
    }

// Handle form submission
    public function submit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:5000',
        ]);
 // Redirect back with a success message
        return back()->with('success', 'Thank you for contacting us. We will get back to you soon.');
    }
}
