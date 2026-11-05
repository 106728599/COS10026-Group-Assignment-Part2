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
    <h2 style="text-align: center; font-size: 24px;">About Travexa</h2>
    <p style="font-size: 20px;">Travexa is a travel company dedicated to making every journey enjoyable, convenient, and memorable. We provide travel services and carefully planned experiences to help customers discover new destinations, explore different cultures, and create unforgettable memories. Whether it is a relaxing holiday, an exciting adventure, or a family trip, Travexa aims to make travelling easier from planning to the journey itself.</p>
    <form>
        <label id="SearchDestination">
        <input type="text" placeholder="Search destinations">
        <button type="submit">Search</button>
        </label>
    </form>
    
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
        <table>
            <tr>
                <th colspan="5" id="Japan">Japan</th>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td>Hokkaido</td>
                <td>Osaka</td>
                <td>Kyoto</td>
                <td>Shikoku</td>
            </tr>
            <tr>
                <td><img src="Images/tokyo.jpg" alt="Tokyo" width="200" height="200"></td>
                <td><img src="Images/hokkaido.jpg" alt="Hokkaido" width="200" height="200"></td>
                <td><img src="Images/osaka.jpg" alt="Osaka" width="200" height="200"></td>
                <td><img src="Images/kyoto.jpg" alt="Kyoto" width="200" height="200"></td>
                <td><img src="Images/shikoku.jpg" alt="Shikoku" width="200" height="200"></td>
            </tr>
             <tr>
                <td colspan="5" style="text-align: center;">Blend ancient traditions with modern wonders. From Tokyo's neon lights to Kyoto's serene temples, Japan offers an unforgettable journey.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="China">China</th>
            </tr>
            <tr>
                <td>Beijing</td>
                <td>Shanghai</td>
                <td>Guangzhou</td>
                <td>Shenzhen</td>
                <td>Chengdu</td>
            </tr>
            <tr>
                <td><img src="Images/beijing.jpg" alt="Beijing" width="200" height="200"></td>
                <td><img src="Images/shanghai.jpg" alt="Shanghai" width="200" height="200"></td>
                <td><img src="Images/guangzhou.jpg" alt="Guangzhou" width="200" height="200"></td>
                <td><img src="Images/shenzhen.jpg" alt="Shenzhen" width="200" height="200"></td>
                <td><img src="Images/chengdu.jpg" alt="Chengdu" width="200" height="200"></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;">Ancient wonders meet modern marvels. Explore the Great Wall, bustling megacities, and rich cultural heritage.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="Greece">Greece</th>
            </tr>
            <tr>
                <td>Athens</td>
                <td>Thessaloniki</td>
                <td>Crete</td>
                <td>Rhodes</td>
                <td>Corfu</td>
            </tr>
             <tr>
                <td><img src="Images/athens.jpg" alt="Athens" width="200" height="200"></td>
                <td><img src="Images/thessaloniki.jpg" alt="Thessaloniki" width="200" height="200"></td>
                <td><img src="Images/crete.jpg" alt="Crete" width="200" height="200"></td>
                <td><img src="Images/rhodes.jpg" alt="Rhodes" width="200" height="200"></td>
                <td><img src="Images/corfu.jpg" alt="Corfu" width="200" height="200"></td>
            </tr>
             <tr>
                <td colspan="5"  style="text-align: center;">Where history meets the sea. Discover ancient ruins, sun-drenched islands, and Mediterranean charm.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="Korea">Korea</th>
            </tr>
            <tr>
                <td>Seoul</td>
                <td>Busan</td>
                <td>Jeju Island</td>
                <td>Incheon</td>
                <td>Gyeongju</td>
            </tr>
             <tr>
                <td><img src="Images/seoul.jpg" alt="Seoul" width="200" height="200"></td>
                <td><img src="Images/busan.jpg" alt="Busan" width="200" height="200"></td>
                <td><img src="Images/jeju_island.jpg" alt="Jeju Island" width="200" height="200"></td>
                <td><img src="Images/incheon.jpg" alt="Incheon" width="200" height="200"></td>
                <td><img src="Images/gyeongju.jpg" alt="Gyeongju" width="200" height="200"></td>
            </tr>
             <tr>
                <td colspan="5" style="text-align: center;">Tradition and trend in perfect harmony. Experience vibrant cities, serene temples, and breathtaking island landscapes.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="Indonesia">Indonesia</th>
            </tr>
            <tr>
                <td>Jakarta</td>
                <td>Bali</td>
                <td>Surabaya</td>
                <td>Medan</td>
                <td>Bandung</td>
            </tr>
              <tr>
                <td><img src="Images/jakarta.jpg" alt="Jakarta" width="200" height="200"></td>
                <td><img src="Images/bali.jpg" alt="Bali" width="200" height="200"></td>
                <td><img src="Images/surabaya.jpg" alt="Surabaya" width="200" height="200"></td>
                <td><img src="Images/medan.jpg" alt="Medan" width="200" height="200"></td>
                <td><img src="Images/bandung.jpg" alt="Bandung" width="200" height="200"></td>
            </tr>
              <tr>
                <td colspan="5" style="text-align: center;">A tropical paradise of diverse cultures. From bustling Jakarta to the serene beaches of Bali.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="UnitedStates">United States</th>
            </tr>
            <tr>
                <td>New York</td>
                <td>Los Angeles</td>
                <td>Chicago</td>
                <td>Miami</td>
                <td>San Francisco</td>
            </tr>
             <tr>
                <td><img src="Images/new_york.jpg" alt="New York" width="200" height="200"></td>
                <td><img src="Images/los_angeles.jpg" alt="Los Angeles" width="200" height="200"></td>
                <td><img src="Images/chicago.jpg" alt="Chicago" width="200" height="200"></td>
                <td><img src="Images/miami.jpg" alt="Miami" width="200" height="200"></td>
                <td><img src="Images/san_francisco.jpg" alt="San Francisco" width="200" height="200"></td>
            </tr>
             <tr>
                <td colspan="5" style="text-align: center;">From coast to coast, endless possibilities. Experience iconic cities, stunning national parks, and diverse cultures.</td>
            </tr>

        </table>
        <br><br><br><br><br><br><br><br><br><br>
        <table>
            <tr>
                <th colspan="5" id="Australia">Australia</th>
            </tr>
            <tr>
                <td>Sydney</td>
                <td>Melbourne</td>
                <td>Brisbane</td>
                <td>Perth</td>
                <td>Adelaide</td>
            </tr>
            <tr>
                <td><img src="Images/sydney.jpg" alt="Sydney" width="200" height="200"></td>
                <td><img src="Images/melbourne.jpg" alt="Melbourne" width="200" height="200"></td>
                <td><img src="Images/brisbane.jpg" alt="Brisbane" width="200" height="200"></td>
                <td><img src="Images/perth.jpg" alt="Perth" width="200" height="200"></td>
                <td><img src="Images/adelaide.jpg" alt="Adelaide" width="200" height="200"></td>
            </tr>
              <tr>
                <td colspan="5" style="text-align: center;">Where nature and modern life collide. Explore vibrant cities, stunning beaches, and unique wildlife.</td>
            </tr>
        </table>
        <br><br><br><br><br><br><br><br><br><br>
    </div>
    </div>
    <?php
        include 'footer.inc';
    ?>
</body>

</html>
