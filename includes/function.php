<?php
// ============================================
// FUNCTIONS FILE - Reusable Helper Functions
// ============================================

/**
 * Check if user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Get current user's role
 */
function getUserRole() {
    if (!isLoggedIn()) return null;
    return $_SESSION['role'] ?? 'student';
}

/**
 * Check if user is admin
 */
function isAdmin() {
    return getUserRole() === 'admin';
}

/**
 * Require login - redirect if not logged in
 */
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit();
    }
}

/**
 * Require admin - redirect if not admin
 */
function requireAdmin() {
    requireLogin();
    if (!isAdmin()) {
        header("Location: quiz.php");
        exit();
    }
}

/**
 * Get user full name
 */
function getUserName() {
    return $_SESSION['full_name'] ?? 'Guest';
}
?>