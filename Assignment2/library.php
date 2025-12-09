<?php
// ---------------------------
// DATABASE CONNECTION
// ---------------------------
$servername = "localhost";
$username = "root";
$password = "TamaraCariappa@18";
$dbname = "librarydb"; // keep your database name the same

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// ---------------------------
// HANDLE FORM SUBMISSION
// ---------------------------
if (isset($_POST['Submit'])) {

    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Email = $_POST['Email'];
    $PhoneNumber = $_POST['PhoneNumber'];
    $Gender = isset($_POST['Gender']) ? $_POST['Gender'] : "";
    $Dob = $_POST['Dob'];
    $Address = $_POST['Address'];
    $CollegeId = $_POST['CollegeId'];
    $Dept = $_POST['Dept'];
    $Year = $_POST['Year'];
    $CardType = isset($_POST['CardType']) ? $_POST['CardType'] : "";
    $IssueDate = $_POST['IssueDate'];
    $Password = $_POST['Password'];
    $Comments = $_POST['Comments'];
    $Declaration = isset($_POST['Declaration']) ? $_POST['Declaration'] : "";

    // Handle genres (checkbox array)
    $Genres = "";
    if (isset($_POST['Genres']) && is_array($_POST['Genres'])) {
        $Genres = implode(", ", $_POST['Genres']);
    }

    $sql = "INSERT INTO library_cards 
        (first_name, last_name, email, phone, gender, dob, address, college_id, dept, year, card_type, genres, issue_date, password, comments, declaration)
        VALUES 
        ('$Fname', '$Lname', '$Email', '$PhoneNumber', '$Gender', '$Dob', '$Address', '$CollegeId', '$Dept', '$Year', '$CardType', '$Genres', '$IssueDate', '$Password', '$Comments', '$Declaration')";

    mysqli_query($conn, $sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Library Registration - Save & View</title>
    <link rel="stylesheet" href="style4.css">
</head>

<body style="background-color: #FFFAFA">
    <center>
        <div id="div-container">
            <h1>Library Card Registrations</h1>

            <p>
                <a href="library_form.html">Back to Registration Form</a>
            </p>

            <?php
            // ---------------------------
            // RETRIEVE AND DISPLAY DATA
            // ---------------------------
            $sql_select = "SELECT * FROM library_cards";
            $result = mysqli_query($conn, $sql_select);

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table border='1' cellpadding='8' cellspacing='0'>";
                echo "<tr style='background-color:#F8E1EC;'>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>College ID</th>
                        <th>Dept</th>
                        <th>Year</th>
                        <th>Card Type</th>
                        <th>Genres</th>
                        <th>Issue Date</th>
                        <th>Comments</th>
                    </tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['college_id'] . "</td>";
                    echo "<td>" . $row['dept'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['card_type'] . "</td>";
                    echo "<td>" . $row['genres'] . "</td>";
                    echo "<td>" . $row['issue_date'] . "</td>";
                    echo "<td>" . $row['comments'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No registrations yet.</p>";
            }

            mysqli_close($conn);
            ?>

            <br>
            <p style="color: #7D1C4A; text-align: right; width: 100%;">
                1CR23CS197, Tamara Cariappa, C2
            </p>
        </div>
    </center>
</body>

</html>
