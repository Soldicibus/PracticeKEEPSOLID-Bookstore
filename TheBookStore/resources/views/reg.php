<?php
use Illuminate\Support\Facades\Auth;

if (Auth::check()) {
    $user = Auth::user();
    // Do something with $user
} else {
    // User is not authenticated
}
?>