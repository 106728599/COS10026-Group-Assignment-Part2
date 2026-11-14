<!DOCTYPE html> 
<html lang="en">
<head>
    <link href="styles.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="description" content="Creating a website for a Travel & Tourism Technology Company">
    <meta name="keywords" content="reference number, job title, salary, responsibilities, requirements">
    <meta name="author" content="Soo Kian Meng, Pang Hui Xin, Jarome Loo, Lee Xiao Yan">
    <title>Web Technology Project Group Assignment</title>
    <style>
        .contactNumber h3 {
            color: #6f5b8e;
            margin-bottom: 15px;
        }

        .contactNumber h4 {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>

<?php
    include 'settings.php';

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    include 'header.inc';
?>

<body class="about">
    <img src="Images/about_pic1.jpeg" alt="aboutUsBackground">
    <h1 style="text-align: center;">About Us</h1>
    <h2 id="groupTitle">Our Group's Information</h2>
    <div id="information">
        <ol>
            <li>Group Name: Ice Cream</li>
            <li>Group Number: G08</li>
            <li>Class Date And Time: 
                <ul>
                    <li>Day: Monday
                        <ul>
                            <li>Time: 4.00pm - 6.00pm</li>
                        </ul>
                    </li>
                    <li>Day: Thursday
                        <ul>
                            <li>Time: 2.00pm - 4.00pm</li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ol>
    </div>

<h2>Our Members</h2>
<div id="members">
    <dl>
<?php
    $sql = "SELECT * FROM about ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $photo = "";
            $quote = "";
            $english = "";
            if ($row['member_name'] == 'Soo Kian Meng') {
                $photo = "Images/kianmeng_image.jpeg";
                $quote = "不忘初心，方得始终。";
                $english = "Stay true to your original purpose, and you will reach the end.";
            }
            elseif ($row['member_name'] == 'Pang Hui Xin') {
                $photo = "Images/huixin_image.jpeg";
                $quote = "不要让那些做得不够好的事情定义你。继续前行，继续成长，相信自己正在一点一点变得更好。";
                $english = "Don't let what you haven't done well define you. Keep going, keep growing, and trust that you're becoming better, little by little.";
            }
            elseif ($row['member_name'] == 'Jarome Loo') {
                $photo = "Images/jarome_image.jpeg";
                $quote = "大智若愚，大巧若拙。";
                $english = "Great wisdom looks like folly.";
            }
            elseif ($row['member_name'] == 'Lee Xiao Yan') {
                $photo = "Images/xiaoyan_image.jpeg";
                $quote = "不积跬步，无以至千里。";
                $english = "A journey of a thousand miles begins with a single step.";
            }
?>
    <dt><?php echo htmlspecialchars($row['member_name']); ?></dt>
    <div class="memberContent">
        <img src="<?php echo $photo; ?>" alt="Photo of <?php echo htmlspecialchars($row['member_name']); ?>">
        <div class="memberText">
            <dd class="studentID">
                Student ID: <?php echo htmlspecialchars($row['student_id']); ?>
            </dd>
            <dd>
                Part 1 Contribution:
                <?php echo htmlspecialchars($row['part1_contribution']); ?>
            </dd>
            <dd>
                Part 2 Contribution:
                <?php echo htmlspecialchars($row['part2_contribution']); ?>
            </dd>
            <dd>
                Quote: <?php echo htmlspecialchars($quote); ?>
            </dd>
            <dd>
                English: <?php echo htmlspecialchars($english); ?>
            </dd>
        </div>
    </div>
<?php
        }
    } else {
        echo "No member information found.";
    }
?>
</dl>
</div>

    <h2>Group Photo</h2>
    <div id="groupPhoto">

        <div class="groupText">
            <h3>Meet Our Team</h3>

            <p>
                We are Ice Cream, a creative team working together to build
                TRAVEXA and create a better travel experience through technology.
            </p>

            <p>
                By combining our ideas, skills and creativity, we work together
                to develop innovative solutions for the future of travel.
            </p>
        </div>

        <figure>
            <img src="Images/Group Photo.jpeg" alt="Group photo of Ice Cream group">
            <figcaption>Ice Cream Group - G08</figcaption>
        </figure>
    </div>

    <h2>Fun Facts</h2>
    <div id="funfact">
        <table>
            <caption>Fun Facts About Our Members</caption>
            <tr>
                <th>Name</th>
                <th>Dream Job</th>
                <th>Coding Snack</th>
                <th>Hometown</th>
            </tr>
            
            <tr>
                <td>Soo Kian Meng</td>
                <td>Vulnerability Tester</td>
                <td>Coffee And Tea</td>
                <td>Selangor</td>
            </tr>

            <tr>
                <td>Pang Hui Xin</td>
                <td>UI/UX Designer</td>
                <td>Bubble Tea</td>
                <td>Johor Bahru</td>
            </tr>

            <tr>
                <td>Jarome Loo</td>
                <td>Boss</td>
                <td>Nugget</td>
                <td>Selangor</td>
            </tr>

            <tr>
                <td>Lee Xiao Yan</td>
                <td>Data Analyst</td>
                <td>French Fries</td>
                <td>Kuala Lumpur</td>
            </tr>
        </table>
    </div>

    <div id="hometownMap">
        <img src="Images/hometown_image.jpeg" alt="Map showing the hometowns of our group members in Malaysia">
    </div>

    <h2>Our Commitment to Inclusion</h2>

    <div id="acknowledgement">
        <p>
            TRAVEXA acknowledges and respects Aboriginal and Torres Strait Islander
            peoples, their cultures, histories and continuing connection to Country.
            We are committed to providing an inclusive and respectful workplace and
            welcome applications from Aboriginal and Torres Strait Islander peoples.
        </p>
    </div>

    <h2 id="contact">Our Contact</h2>
    <h3>Any Questions? Feel Free To Contact Our Staff!</h3>
    <div id="contactInfo">
        <div class="contactNumber">
            <h3>Office Number 1: </h3>
            <h4>+6012 777 9145</h4>
        </div>
        <div class="contactNumber">
            <h3>Office Number 2: </h3>
            <h4>+6014 919 3140</h4>
        </div>
    </div>

    <?php
        include 'footer.inc';
    ?>
</body>

</html>
