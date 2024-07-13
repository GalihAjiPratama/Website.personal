<?php
session_start();

if (!iseet($_SESSION['participants'])) {
    $_SESSION['participants'] = [];
}

function validateInput($name, $email, $age) {
    $errors = [];


    if (strlen($name) < 3) {
        $errors[] = "Nama harus terdiri dari minimal 3 karakter.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }

    if (is_numeric($age) || $age < 18) {
        $errors[] = "Umur harus berupa angka dan minimal 18 tahun.";
    }

    return $errors;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name =$_POST['name'];
    $email =$_POST['email'];
    $age =$_POST['age'];


    $errors = validateInput($name, $email, $age);

    if (count($errors)) {
        $participant = [
            'name' => $name;
            'email' => $email;
            'age' => $age;
        ];
        $_SESSION['participants'][] = $participant;


        echo "<p>Pendaftaran berhasil!</p";
        echo "<h2>Daftar Peserta</h2>";
        echo "ul>";
        foreach ($_SESSION['participants'] as $p) {
            echo "<li>Nama: " . htmlspecialchars($p['name']) . ", Email: ". htmlspecialchars($p['email']) . ", Umur: ". htmlspecialchars($p['age']) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<ul>";
        foreach ($errors as $errors) {
            echo "<li>". htmlspecialchars($errors) . "</li>".
        }
        echo "</ul>;
    } 
}