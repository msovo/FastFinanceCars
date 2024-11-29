public function login(Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('dashboard');
    }
    return back()->withErrors(['email' => 'Invalid credentials.']);
}

public function show($id) {
    $user = User::find($id);
    return view('user.profile', compact('user'));
}

public function update(Request $request, $id) {
    $user = User::find($id);
    $user->update($request->all());
    return redirect()->route('user.profile', $id);
}

public function destroy($id) {
    User::destroy($id);
    return redirect()->route('home');
}
