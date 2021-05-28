<?php
include $_SERVER['DOCUMENT_ROOT'] . '/utilities/functions.php'; 

if(!isset($_POST['email']) OR !isset($_POST['password'])){
    header('Location: /');
    exit();
}else{
    if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
        header('Location: /login?code=invalid_email');
        exit();
    } else {
        include $_SERVER['DOCUMENT_ROOT'] . '/db.php'; 
        $sql = "SELECT * FROM users WHERE email=:email LIMIT 1";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'email'=>$_POST['email']
            ]);
            $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(count($userData)==0){
                header('Location: /login?code=auth_failed'); //no user was found with this email
                exit();
            }else{
                if (password_verify($_POST['password'], $userData[0]['password'])) {
                    header('Location: /admin_section'); //successful login
                    exit();
                } else {
                    header('Location: /login?code=auth_failed'); //failed login
                    exit();
                }
            }
        } catch (Exception $e) {
            header('Location: /login?code=auth_failed');
            exit();
        }
    }
}


?>
