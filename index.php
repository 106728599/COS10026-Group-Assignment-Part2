<?php
require_once 'settings.php';

$conn = mysqli_connect($host, $user, $pwd, $db);

if (!$conn) die('Database connection failed: ' . mysqli_connect_error());
mysqli_set_charset($conn, 'utf8mb4');

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
    $safe = mysqli_real_escape_string($conn, $search);
    $sql = "SELECT * FROM destinations 
            WHERE `Country Name` LIKE '%$safe%' 
               OR `Cities` LIKE '%$safe%' ";
} else {
    $sql = "SELECT * FROM destinations";
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
        #countries{
            width: 80%; 
            margin: 0 auto; 
            display: flex;
            flex-direction: column; 
            align-items: center;
        }

        #countryNav {
            margin-top: 20px;
            width: 80px;
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 170px;
            font-size: 20px;
            z-index:1;
        }

        #countryNav a {
            color: none;
            text-decoration: underline;
            font-weight: bold;
            border: none;
            padding: none;
        }

        #countryNav a:hover {
            background-color: #8f80ad;
        }

        .MainLayout{
            display:flex;
            align-items: flex-start;
        }

        #countryNav ul{
            line-height: 1.7;
        }
        
        th {
            scroll-margin-top: 260px;
        }
        
        body{
            background-image:url(Images/jobbackground.jpg);
            background-repeat:no-repeat;
            background-size:cover;
            background-attachment: fixed;
        }

    </style>
</head>
<?php
    include 'header.inc';
?>
<body>
    <section class="images"></section>
    <h1 style="text-align: center;"><strong>Home</strong></h1>

    <div id="search-destination">
    <h2 style="text-align: center; font-size: 24px;">About Travexa</h2>
    <p style="font-size: 20px;">Travexa is a travel company dedicated to making every journey enjoyable, convenient, and memorable. We provide travel services and carefully planned experiences to help customers discover new destinations, explore different cultures, and create unforgettable memories. Whether it is a relaxing holiday, an exciting adventure, or a family trip, Travexa aims to make travelling easier from planning to the journey itself.</p>

    <form action="index.php#search-destination" method="GET">
        <label id="SearchDestination">Enter Destination:</label>
        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="e.g., China">
        <input type="submit" value="Search">
        <?php if ($search !== ''): ?>
            <a href="index.php#search-destination" style="margin-left: 10px;">Clear Search</a>
        <?php endif; ?>
    </form>
    
    <?php if ($search !== ''): ?>
        <p style="margin-top: 15px; font-size: 18px;">Showing results for: <strong><?php echo htmlspecialchars($search); ?></strong></p>
    <?php endif; ?>
    </div>

    <div>

    <?php if (mysqli_num_rows($result) === 0): ?>
    <p style="text-align: center; font-size: 20px;">No destination found<?php echo $search !== '' ? ' for "' . htmlspecialchars($search) . '"' : ''; ?>.</p>
    <?php else: ?>

    <div class="MainLayout">
    <nav id="countryNav">
        <h3>Featured Destinations</h3>
        <ul>
        <li><a href="#Japan">Japan</a></li>
        <li><a href="#China">China</a></li>
        <li><a href="#Greece">Greece</a></li>
        <li><a href="#Korea">Korea</a></li>
        <li><a href="#Indonesia">Indonesia</a></li>
        <li><a href="#UnitedStates">United States</a></li>
        <li><a href="#Australia">Australia</a></li>
        </ul>
        <br><br><br><br><br>
    </nav>
    <div id="countries">

    <?php while ($row = mysqli_fetch_assoc($result)): 
     $country = $row['Country Name'];
     $anchorId = str_replace(' ', '', $country);
     $cityList = preg_split('/[\n,]+/', $row['Cities']); 
    ?>
        <table>
            <tr>
                <th colspan="5" id="<?php echo htmlspecialchars($anchorId); ?>">
                    <?php echo htmlspecialchars($country); ?>
                </th>
            </tr>
            <tr>
                <?php foreach ($cityList as $city): ?>
                            <td><?php echo htmlspecialchars(trim($city)); ?></td>
                        <?php endforeach; ?>
            </tr>
            <tr>
                <?php foreach ($cityList as $city): 
                                $city = trim($city);
                                if(empty($city)) continue; 
                                $imgName = strtolower(str_replace(' ', '_', $city));
                ?>
                <td><img src="Images/<?php echo $imgName; ?>.jpg" alt="<?php echo htmlspecialchars($city); ?>" width="200" height="200"></td>
                <?php endforeach; ?>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;"><?php echo htmlspecialchars($row['Description']); ?></td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>

        <?php endwhile; ?>
        <?php endif; ?>

        
    </div>
    </div>
    <?php
        include 'footer.inc';
    ?>
</body>

</html>
