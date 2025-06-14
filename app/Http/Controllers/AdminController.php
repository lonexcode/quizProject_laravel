<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\Mcq;
use Symfony\Component\Console\Question\Question;

class AdminController extends Controller
{
    function login(Request $request)
    {
        $validation = $request->validate([
            'admin_name' => 'required|min:3',
            'admin_password' => 'required',
        ]);

        $admin = Admin::where([['name', '=', $request->admin_name], ['password', '=', $request->admin_password]])->first();

        if (!$admin) {
            $validation = $request->validate(
                [
                    'user' => 'required|min:3',
                ],
                [
                    'user.required' => 'User not Found',
                ]
            );
        }

        Session::put('admin', $admin);
        return redirect('dashboard');
    }

    function showQuiz($id,$quizname)
    {
        $admin = Session::get('admin');
        $name = $admin['name'];
        $mcq = Mcq::where('quiz_id', $id)->get();

        if ($admin) {
            return view('show-quiz', ['name' => $name, 'data' => $mcq,'quizname'=>$quizname]);
        } else {
            redirect('admin-login');
        }
    }

    function dashboard()
    {
        $admin = Session::get('admin');

        $name = $admin['name'];
        if ($admin) {
            return view('dashboard', ['name' => $name]);
        } else {
            redirect('admin-login');
        }
    }

    function cateogaries()
    {
        $admin = Session::get('admin');
        $name = $admin['name'];

        $data = Category::get();

        if ($admin) {
            return view('cateogaries', ['name' => $name, 'data' => $data]);
        } else {
            redirect('admin-login');
        }
    }

    function logout()
    {
        Session::flush(); // Clear all session data

        //you can also use Session::forget('admin');
        return redirect('admin-login'); // Redirect to login page
    }

    public function AddCategory(Request $request)
    {
        $validation = $request->validate(
            [
                'category' => 'required|min:3|max:50|unique:categories,name',
            ],
            [
                'category.unique' => 'Category already exists.',
                'category.min' => 'Minimum 3 characters are required.',
                'category.max' => 'Maximum 50 characters are allowed.',
            ]
        );

        // Get the category name from input
        $categoryName = $request->input('category');

        // Get the admin user from session
        $admin = Session::get('admin');

        // Create new Category instance
        $category = new Category();
        $category->name = $categoryName;
        $category->creator = $admin['name']; // Make sure 'name' exists in session data

        // Try saving and check if successful
        if ($category->save()) {
            return redirect()
                ->back()
                ->with('category-success', 'Category ' . $request->category . ' added successfully!');
        } else {
            return redirect()
                ->back()
                ->with('category-error', 'Failed to add category. Please try again.');
        }
    }

    public function delCategory($id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();
            return redirect()
                ->back()
                ->with('category-success', 'Category deleted successfully.');
        } else {
            return redirect()
                ->back()
                ->with('category-error', 'Category not found.');
        }
    }

    function addQuiz()
    {
        //return Session::get('quizDetails');
        $admin = Session::get('admin');
        $name = $admin['name'];
        $category = Category::get();
        $totlmcq = 0;
        if ($admin) {
            $quiznmae = request('quiz');
            $catId = request('cat_id');

            if ($quiznmae && $catId && !Session::has('quizDetails')) {
                $quiz = new Quiz();
                $quiz->name = $quiznmae;
                $quiz->category_id = $catId;

                if ($quiz->save()) {
                    Session::put('quizDetails', $quiz);
                }
            } else {
                $quix = Session::get('quizDetails');

                $count = $quix && Mcq::where('quiz_id', $quix->id)->count();
                if ($count > 0) {
                    $totlmcq = Mcq::where('quiz_id', $quix->id)->count();
                } else {
                    $totlmcq = 0;
                }
            }

            return view('add-quiz', ['name' => $name, 'category' => $category, 'total' => $totlmcq]);
        }
    }


    public function AddMcq(Request $request)
    {
        $request->validate([
            'question' => 'required|string|min:10',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'correct_ans' => 'required|in:a,b,c,d',
        ]);

        $mcq = new Mcq();
        $mcq->question = $request->question;
        $mcq->a = $request->a;
        $mcq->b = $request->b;
        $mcq->c = $request->c;
        $mcq->d = $request->d;
        $mcq->correct_ans = $request->correct_ans;

        // Access session data correctly
        $quizDetails = Session::get('quizDetails');
        $admin = Session::get('admin');

        $mcq->category_id = $quizDetails['category_id'] ?? null;
        $mcq->quiz_id = $quizDetails['id'] ?? null;
        $mcq->admin_id = $admin['id'] ?? null;

        if ($mcq->save()) {
            if ($request->submit == 'add-more') {
                // return back()->with('success', 'MCQ added successfully!');
                return redirect(url()->previous());
            } else {
                Session::forget('quizDetails');
                return redirect('/cateogaries');
            }
        }
    }

    function endQuiz()
    {
        Session::forget('quizDetails');
        return redirect('/cateogaries');
    }


    function QuizList($id, $category)
    {
        $admin = Session::get('admin');
        if ($admin) {
            $quizData = Quiz::where('category_id', $id)->get();
            return view('quiz-list', ['name' => $admin->name, 'quizdata' => $quizData, 'category' => $category]);
        } else {
            return redirect('admin-login');
        }
    }
}
