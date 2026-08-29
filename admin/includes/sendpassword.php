<?php
session_start();

// This previously reset a user's password to an attacker-chosen value for any
// known email address with no proof of ownership (no emailed token, no current
// password check) - a full account-takeover vulnerability. Self-service reset
// via this form is disabled until it is rebuilt with real email verification.
// Passwords can still be changed by a logged-in admin from the Users screen.
echo "Self-service password reset is disabled. Please contact an administrator to reset your password.";
echo "<BR><a href='../index.php'>Back to login</a>";
?>

