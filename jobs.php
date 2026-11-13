<?php
require_once 'settings.php';

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) die('Database connection failed: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8mb4');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $safe = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM jobs 
            WHERE `Title` LIKE '%$safe%' 
               OR `description` LIKE '%$safe%'
              OR `Reference Number` LIKE '%$safe%'
              OR `Essential Requirements` LIKE '%$safe%'
              OR `Responsibilities` LIKE '%$safe%'
              OR `Preferred Qualifications` LIKE '%$safe%'
              OR `Salary` LIKE '%$safe%'
              OR `Reporting to` LIKE '%$safe%'
            ORDER BY `Reference Number`";
} else {
    $sql = "SELECT * FROM jobs ORDER BY `Reference Number`";
}

$result = mysqli_query($conn, $sql);
if (!$result) die('Query failed: ' . mysqli_error($conn));
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
        .jobs {
            font-family:"Arial", sans-serif;
            background-image:url(Images/jobbackground.jpg);
            background-repeat:no-repeat;
            background-size:cover;
            background-attachment: fixed;
        }

        table img{
                border-radius: 15px;
        }
    </style>
</head>
<?php
    include 'header.inc';
?>
<body class="jobs">
    <section class="jobimages"></section>
    <h1 style="text-align: center;"><strong>Jobs</strong></h1>
    <h1>Join Travexa!!</h1>

    <div id="search-area">
    <p style="font-size: 24px;">We create unforgettable journeys across countries. If you're passionate about travel and technology, we'd love to have you on our team!</p>
    <br>
    <h1>Current Job Openings</h1>

    <form action="jobs.php#search-area" method="GET">
        <label for="searchKeyword">Enter Keyword:</label>
        <input type="text" id="searchKeyword" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="e.g., Data, TRV26">
        <input type="submit" value="Search">
        <?php if ($search !== ''): ?>
            <a href="jobs.php#search-area" style="margin-left: 10px;">Clear Search</a>
        <?php endif; ?>
    </form>

    <?php if ($search !== ''): ?>
        <p style="margin-top: 15px; font-size: 18px;">Showing results for: <strong><?php echo htmlspecialchars($search); ?></strong></p>
    <?php endif; ?>
    <div>
    
    <?php if (mysqli_num_rows($result) === 0): ?>
    <p style="text-align: center; font-size: 20px;">No keyword found<?php echo $search !== '' ? ' for "' . htmlspecialchars($search) . '"' : ''; ?>.</p>
    <?php else: ?>

    <!--loop-->
    <?php while ($row = mysqli_fetch_assoc($result)): ?>

    <section class="job-posting">
        <div class="pill">Reference Number: <?php echo htmlspecialchars($row['Reference Number']); ?></div>
        <div class="<?php echo ($row['Reference Number'] == 'TRV26') ? 'accent-bar' : 'accent-bar4'; ?>">

            <h2><strong>Job Title:<?php echo htmlspecialchars($row['Title']); ?></strong></h2>
            <p style="font-size: 22px;"><?php echo htmlspecialchars($row['description']); ?></p>
        <hr>
            
            <div class="main-content">
                <div class="accent-bar3">
                <h3 >Responsibilities</h3>
                <ol >
                   <?php foreach (explode("\n", $row['Responsibilities']) as $item): ?>
                    <?php if (trim($item) !== ''): ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
                <h3 >Essential Requirements</h3>
                <ul >
                   <?php foreach (explode("\n", $row['Essential Requirements']) as $item): ?>
                    <?php if (trim($item) !== ''): ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <h3 >Preferred Qualifications</h3>
                <ul >
                    <?php foreach (explode("\n", $row['Preferred Qualifications']) as $item): ?>
                    <?php if (trim($item) !== ''): ?>
                        <li><?php echo htmlspecialchars(trim($item)); ?></li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                </div>

                <aside class="accent-bar2">
                    <img src="<?php echo htmlspecialchars($row['Images']); ?>" 
                        alt="<?php echo htmlspecialchars($row['Title']); ?>" style="width:100%;">
                    <p> <?php echo htmlspecialchars($row['Salary']); ?></p>
                    <p><strong>Reporting to: </strong></p>
                    <p><?php echo htmlspecialchars($row['Reporting to']); ?></p>
                    <hr>
                    <button style="margin-top:15px; padding: 20px; width:100%; font-size:18px;">
                        <a href="apply.php?job_ref=<?php echo urlencode($row['Reference Number']); ?>">
                            Apply for <?php echo htmlspecialchars($row['Title']); ?>
                        </a></button>
                </aside>
            </div>
        </div>
    </section>
    <br><br><br><br><br><br>
    <?php endwhile; ?>
    <?php endif; ?>
        
        <div class="accent-bar5">
            <h3><strong>WHY JOIN US?</strong></h3>
            <ul>
                <li>Competitive salary and performance-based bonuses.</li>
                <li>Opportunities for career growth and professional development.</li>
                <li>Collaborative and inclusive work environment.</li>
                <li>Access to cutting-edge technologies and tools.</li>
                <li>Employee wellness programs and benefits.</li>
            </ul>
            <br><br>
            <table>
                <tr>
                    <td><img src="Images/job.jpg" alt="job" width="250" height="250"></td>
                    <td><img src="Images/job2.jpg" alt="job2" width="250" height="250"></td>
                    <td><img src="Images/job5.jpg" alt="job5" width="250" height="250"></td>
                    <td><img src="Images/job3.jpg" alt="job3" width="250" height="250"></td>
                    <td><img src="Images/job4.jpg" alt="job4" width="250" height="250"></td>
                </tr>
            </table>
        <br><br>
        <p><strong>Ready to take the next step in your career? Apply now!</strong></p>
        <p><strong>For more information about our company and the application process, please see the application section above.</strong></p>
        </div>

    <?php
        include 'footer.inc';
    ?>
</body>
</html>
