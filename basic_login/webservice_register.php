<?php



function registerVenue($data){
    include $_SERVER['DOCUMENT_ROOT'] . '/db.php'; 

    //generate GUID, generate RCODE, check if email already exists
    //encrypt password & add hash
    $sql = "SELECT ID FROM users WHERE email=:email LIMIT 1";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'email'=>$data['email']
        ]);
        $emailCheck = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($emailCheck)!=0){
            return 'email_taken';
        }
    } catch (Exception $e) {
        return 'query_failed';
    }
    if($data['password']==''){
        return 'failed';
    }
    $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);
    $data['password'] = $hashed_password;

    $sql = "INSERT INTO users (guid,firstName,lastName,email,phoneNumber,password,venueName,venueAddress,venueCity,venueZIP)
    VALUES ('123',:firstName,:lastName,:email,:phoneNumber,:password,:venueName,:venueAddress,:venueCity,:venueZIP)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        } catch (Exception $e) {
            die($e);
        }


    return 'success';
}



if (!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) {
    echo json_encode('invalid_email');
    exit();
} else {
    $data = filter_input_array(INPUT_POST);
    echo json_encode(registerVenue($data));
}


?>
