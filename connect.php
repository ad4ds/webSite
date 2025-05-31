<?php
// Database connection parameters
$servername = "localhost";   // usually localhost
$username = "root";          // your MySQL username
$password = "";              // your MySQL password
$dbname = "project";            // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Helper function to safely get POST data
function get_post($key) {
    return isset($_POST[$key]) ? trim($_POST[$key]) : null;
}

// Prepare variables (make sure your form input 'name' attributes match these keys)
$date_of_registration = get_post('date_of_registration');
$first_name = get_post('first_name');
$last_name = get_post('lastname');
$gender = get_post('Gender');
$nationality = get_post('Nationality');
$date_of_birth = get_post('Date_of_birth');   // changed to no spaces in name attribute
$age = get_post('Age');
$address = get_post('Address');
$phone = get_post('phone');

$father_name = get_post('Fathers_name');       // assuming you changed name="Fathers_name"
$father_work = get_post('Place_of_Work_father'); // you should distinguish father/mother work fields
$father_phone = get_post('Phone_number_father');

$mother_name = get_post('Mothers_name');
$mother_work = get_post('Place_of_Work_mother');
$mother_phone = get_post('Phone_number_mother');

$previous_school = get_post('Name_of_previous_school');
$previous_class = get_post('Previous_class');

$guardian_name = get_post('Name');
$date_signed = get_post('Date_signed');  // date signed from form (change input name accordingly)

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO registrations (date_of_registration, first_name, last_name, gender, nationality, date_of_birth, age, address, phone, father_name, father_work, father_phone, mother_name, mother_work, mother_phone, previous_school, previous_class, guardian_name, date_signed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if(!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssssissssssssssss", 
    $date_of_registration, $first_name, $last_name, $gender, $nationality, $date_of_birth, $age, $address, $phone,
    $father_name, $father_work, $father_phone,
    $mother_name, $mother_work, $mother_phone,
    $previous_school, $previous_class,
    $guardian_name, $date_signed
);

// Execute
if ($stmt->execute()) {
    echo "Registration successful!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
