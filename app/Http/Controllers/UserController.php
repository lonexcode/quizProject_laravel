<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Mcq;

class UserController extends Controller
{
    function welcome()
    {
        // $category=Category::get();

        $categories = Category::withCount('quizzes')->get();
        return view('welcome', ['data' => $categories]);
    }

    function userQuizList($id, $category)
    {
        $quizData = Quiz::withCount('Mcq')
            ->where('category_id', $id)
            ->get();
        return view('user-quiz-list', ['quizdata' => $quizData, 'category' => $category]);
    }

    function userRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|max:30|confirmed',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        if ($user->save()) {
            Session::put('userDetails', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect("$url")->with('success', 'Signed IN Successfully');
            } else {
                return redirect('user-login')->with('success', 'Signed IN Successfully');
            }
        }
    }

    function userLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            return redirect()
                ->back()
                ->with('email', 'User Not Found');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return redirect()
                ->back()
                ->with('password', 'Incorrect Password');
        }

        if ($user->save()) {
            Session::put('userDetails', $user);
            if (Session::has('quiz-url')) {
                $url = Session::get('quiz-url');
                Session::forget('quiz-url');
                return redirect("$url")->with('success', 'Signed IN Successfully');
            } else {
                return redirect('/')->with('success', 'Signed IN Successfully');
            }
        }
    }

    function startQuiz($id, $category)
    {
        $quizCount = Mcq::where('quiz_id', $id)->count();
        $quizdata = Mcq::where('quiz_id', $id)->get();

        Session::put('firstmcq', $quizdata[0]);
        $quizName = $category;

        return view('start-quiz', ['quizname' => $quizName, 'count' => $quizCount]);
    }

    function logoutUser()
    {
        Session::forget('userDetails');
        return redirect('/');
    }

    function userRegisterStartQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-signup');
    }

    function userLoginStartQuiz()
    {
        Session::put('quiz-url', url()->previous());
        return view('user-login');
    }

    function mcq($id, $name)
    {
        // return MCQ::where('quiz_id', Session::get('firstmcq')->quiz_id)->get();

        $currentQuiz = [];
        $currentQuiz['totalMcq'] = MCQ::where('quiz_id', Session::get('firstmcq')->quiz_id)->count();

        $currentQuiz['currentMcq'] = 1;
        $currentQuiz['quizName'] = $name;
        $currentQuiz['quizId'] = Session::get('firstmcq')->quiz_id;

        Session::put('currentQuiz', $currentQuiz);

        $mcqData = MCQ::find($id);

        return view('mcq-page', ['quizName' => $name, 'mcqData' => $mcqData]);
    }



  public function submitAndNext($id)
{
    // 🔸 Retrieve current quiz data (like current question number, quiz ID, name) from the session
    $currentQuiz = Session::get('currentQuiz');

    // 🔸 Move to the next question by incrementing the current MCQ counter
    $currentQuiz['currentMcq'] += 1;

    // 🔸 Save the updated quiz progress back into the session
    Session::put('currentQuiz', $currentQuiz);

    // 🔸 Get the next MCQ from the database
    // We are looking for the next question where:
    // - the MCQ ID is greater than the current one (to move forward)
    // - the quiz_id matches the current quiz
    $mcqData = MCQ::where([
        ['id', '>', $id],
        ['quiz_id', '=', $currentQuiz['quizId']],
    ])->first(); // Only get the first matching MCQ

    // 🔸 If there is a next question (MCQ), load the mcq-page view with quiz name and MCQ data
    if ($mcqData) {
        return view('mcq-page', [
            'quizName' => $currentQuiz['quizName'],
            'mcqData' => $mcqData
        ]);
    } else {
        // 🔸 If no more questions are found, quiz is likely over — go to result page
        return "result page"; // You can change this to a redirect to your result view
    }
}


}
