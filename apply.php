<?php
$job_ref = isset($_GET['job_ref']) ? htmlspecialchars($_GET['job_ref']) : '';
?>

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
        form legend {
            font-weight: bold;
        }
    </style>
</head>
<?php
    include 'header.inc';
?>
<body>
    <section class="apply"></section>
    <div id="applyjob">
    <h1 style="text-align: center;">Apply</h1>
    <div class="apply-intro">
        <h2>Looking For A Job? Sign Up For An Interview!</h2>
    </div>
    <form method="post" action="process_eoi.php" novalidate>
        <fieldset>
            <legend>Application Form</legend>
            <p><label for="jobRefNum">Job Reference Number: </label>
                <input type="text" name="jobRefNum" id="jobRefNum" value="<?php echo $job_ref; ?>" readonly>
            </p>

            <p><label for="firstName">First Name: </label>
                <input type="text" name="firstName" id="firstName" pattern="[a-zA-Z ]{1,20}" required>            
            </p>

            <p><label for="lastName">Last Name: </label>
                <input type="text" name="lastName" id="lastName" pattern="[a-zA-Z ]{1,20}" required>            
            </p>
            <p><label for="dateOfBirth">Date Of Birth: </label> 
                <!--DATE-->
                <!--For pattern 0[1-9] means "number starting from 0 followed by any number from 1 to 9, which covers 01 to 09"-->
                <!--For pattern [12][0-9] means "number starting from either 1 or 2 followed by any number from 1 to 9, which covers 10 to 29"-->
                <!--For pattern 3[0-1] means "number starting from 3 followed by any number from 0 to 1, which covers 30 to 31"-->

                <!--MONTH-->
                <!--For pattern 0[1-9] means "number starting from 0 followed by any number from 1 to 9, which covers 01 to 09"-->
                <!--For pattern 1[0-2] means "number starting from 1 followed by any number from 0 to 2, which covers 10 to 12"-->
                
                <!--YEAR-->
                <!--For pattern 19[0-9]{2} means "number starting from 19 followed by any 2 numbers from 0 to 9, which covers 1900 to 1999"-->
                <!--For pattern [2-9][0-9]{3} means "number starting from any number between 2 to 9 followed by any 3 numbers from 0 to 9, which covers 2000 to 9999"-->

                <!--"/" is the symbol slash in dd/mm/yyyy and "|" is OR-->
                <input type="text" name="dateOfBirth" id="dateOfBirth" placeholder="dd/mm/yyyy" pattern="(0[1-9]|[12][0-9]|3[0-1])/(0[1-9]|1[0-2])/(19[0-9]{2}|[2-9][0-9]{3})" required>
            </p>
          
            <fieldset>
                <legend>Gender: </legend>
                <p><label for="male">Male</label>
                    <input type="radio" name="gender" id="male" value="male" required>
                </p>
                <p><label for="female">Female</label>
                    <input type="radio" name="gender" id="female" value="female">
                </p>
            </fieldset>

            <p><label for="streetAddress">Street Address: </label>
                <input type="text" name="streetAddress" id="streetAddress" maxlength="40" required>
            </p>
            <p><label for="suburbTown">Suburb/Town: </label>
                <input type="text" name="suburbTown" id="suburbTown" maxlength="40" required>
            </p>
            <p><label for="state">State: </label>
                <select name="state" id="state" required>
                    <option value="">Please Select</option>
                    <option value="vic">VIC</option>
                    <option value="nsw">NSW</option>
                    <option value="qld">QLD</option>
                    <option value="nt">NT</option>
                    <option value="wa">WA</option>
                    <option value="sa">SA</option>
                    <option value="tas">TAS</option>
                    <option value="act">ACT</option>
                </select>
            </p>
            <p><label for="postcode">Postcode: </label>
                <input type="text" name="postcode" id="postcode" pattern="\d{4}" required>
            </p>
            <p><label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
            </p>
            <p><label for="phoneNumber">Phone Number: </label>
                <input type="tel" name="phoneNumber" id="phoneNumber" pattern="\d{8,12}" required>
            </p>
            <p><strong>Skill List: </strong></p>
            <p class="skillList">
                <label for="html">HTML</label>
                <input type="checkbox" id="html" name="skills[]" value="html" checked>

                <label for="css">CSS</label>
                <input type="checkbox" id="css" name="skills[]" value="css">

                <label for="javaScript">JavaScript</label>
                <input type="checkbox" id="javaScript" name="skills[]" value="javaScript">

                <label for="php">PHP</label>
                <input type="checkbox" id="php" name="skills[]" value="php">

                <label for="mysql">MySQL</label>
                <input type="checkbox" id="mysql" name="skills[]" value="mysql">
            </p>
            <p class="otherSkillsRow">
                <label for="otherSkills">Other skills:</label>
                <textarea id="otherSkills" name="otherSkills" placeholder="Write other skills here..." rows="5" cols="30"></textarea>
            </p>
        </fieldset>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset form">
    </form>
     </div>

    <img class="apply-banner" src="Images/apply_pic4.jpeg" alt="Travel banner">
    <section class="steps">
        <h2>What Happens After You Apply?</h2>
        <div class="step1">
            <h3>01 - Application Review</h3>
            <p>Our recruitment team will carefully review all your applications and skills.</p>
        </div>

        <div class="step2">
            <h3>02 - Candidate Shortlisting</h3>
            <p>Candidates who match our requirements will be shortlisted for the next stage.</p>
        </div>

        <div class="step3">
            <h3>03 - Interview Process</h3>
            <p>Shortlisted candidates will have the opportunity to take part in an interview and meet our team for further discussion about the role.</p>
        </div>

        <div class="step4">
            <h3>04 - Final Selection</h3>
            <p>Candidates that best fulfill our requirements will be contacted with further information about the position.</p>
        </div>
    </section>

    <h2>Any Questions Please Reach Out To Our Recruitment Team At <a href="about.php#contact">Our Contact</a>.</h2>
    <?php
        include 'footer.inc';
    ?>
</body>

</html>
