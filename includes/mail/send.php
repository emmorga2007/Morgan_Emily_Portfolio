<?php

//TODO: Takes care of the form submission 
//1. Check the submission --> validate the data (make sure theres no problems with the submission, is there "non-mailable items")
//2. prepare your e-mail(prepare its sending format)
//3. Send out the e-mail(send out the package)
//4. It returns proper info in JSON format (becasue in the js that is what format the function is expecting to recieve as the feedback.)
    //a. what is AJAX
    //b. What is JSON
    //c. How to build JASON (in PHP)


    header('Access-Control-Allow-Origin:*');
    header('Content-Type: application/json; charset=UTF-8');
    $results = [];
    
    $visitor_name = '';
    $visitor_email = '';
    $visitor_message = '';
    
    //1. Check the submission --> validate the data (make sure theres no problems with the submission, is there "non-mailable items")
    // we are going to acces one pair of values in the associative array. 
    // How are we going to access the data Submission?
    
    if (isset ($_POST['firstname'])){ 
        $visitor_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING); 
    } else {
        $results['message'] = 'first name not set';
    }
    
    if (isset ($_POST['lastname'])){ 
        $visitor_name .= ' ' .filter_var($_POST['lastname'], FILTER_SANITIZE_STRING); 
    } else {
        $results['message'] = 'last name not set';
    }
    
    if (isset ($_POST['email'])){ 
        $visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
    } else {
        $results['message'] = 'email not set';
    }
    
    if (isset ($_POST['message'])){ 
        $visitor_message = filter_var($_POST['message'], FILTER_SANITIZE_STRING); 
    } else {
        $results['message'] = 'message not set';
    }
    
    $email_headers = array(
        'From'=>$visitor_email
    );
    
    
    $email_subject = "Contact Request";
    $email_recipient = "emily189morgan@gmail.com";
    //TODO: make linking email in cpanel
    $email_message = sprintf('Name: %s, Email %s, Message: %s', $visitor_name, $visitor_email, $visitor_message);
    
    
    // If result.message is set then dont send email because missing input
    if (!$results['message']) {
        $email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
    } else {
        echo json_encode($results);
        exit;
    }
    
    
    if ($email_result) {
        $results['message'] = 'Message sent';
    } else {
        $results['message'] = 'Error, it broken';
    }
    
    echo json_encode($results);