<?php
include 'header.php';
include 'db.php';
?>

<style>
    label {
        display: inline-block;
        width: 200px;
    }
</style>
<?php
$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM results WHERE id = $id");
$sql->execute();
$row = $sql->get_result()->fetch_assoc();

$student_name = $row['student_name'];
$matric_number = $row['matric_number'];
$subject_name = $row['subject_name'];
$subject_code = $row['subject_code'];
$test1 = $row['test_1'];
$test2 = $row['test_2'];
$final_exam = $row['final'];

if (isset($_POST['submit'])) {
    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code']; 
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final_exam = $_POST['final_exam'];

    $total = $test1 + $test2 + $final_exam;

    if($total > 80) 
        $grade = 'A';
    else if ($total > 65) 
        $grade = 'B';
    else if ($total > 50)
        $grade = 'C';
    else if ($total > 40)
        $grade = 'D';
    else 
        $grade = 'E';

    $sql = $conn->prepare("UPDATE results SET
    student_name='$student_name', matric_number='$matric_number',
    subject_name='$subject_name', subject_code='$subject_code',
    test_1=$test1, test_2=$test2, final=$final_exam, total=$total,
    grade='$grade' WHERE id=$id");

    if($sql->execute()) {
        header("Location: index.php");
    }
}
?>

<h2>Edit Results</h2>

<?php
include 'form.php';
include 'footer.php';
?>
