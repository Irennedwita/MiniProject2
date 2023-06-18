<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:purple-login.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:purple-login.php');
}

$conn = mysqli_connect('localhost','root','','purple_calendar');

// $email = $_SESSION['email'];
// $sql = "SELECT * FROM kegiatan WHERE tgl_mulai > '2023-05-' ORDER BY tgl_mulai;"
// $result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Purple Calendar</title>
    <link rel="stylesheet" href="purple.css">
</head>
<body>
    <header>
        <h1>Purple Calendar</h1>
        <a href=""><img src="img/menu.png" alt="icon menu" class="menu"></a>
        <a href=""><img src="img/search.png" alt="icon search" class="search"></a>
        <a href=""><img src="img/setting.png" alt="icon setting" class="setting"></a>
        <span>
            <form class="logout" method="post" action="purple.php" >
                <input class="btnlogout" type="submit" name="logout" value="Log Out"></input>
            </form>
        </span>
    </header>
    <div id="month-year">
        <h2 class="nama">Hallo <?php echo $_COOKIE['name']; ?> !!</h2>
        <select id="month-select" onchange="changeMonth()">
            <option value="0">January</option>
            <option value="1">February</option>
            <option value="2">March</option>
            <option value="3">April</option>
            <option value="4">May</option>
            <option value="5">June</option>
            <option value="6">July</option>
            <option value="7">August</option>
            <option value="8">September</option>
            <option value="9">October</option>
            <option value="10">November</option>
            <option value="11">December</option>
        </select>
        <h2 id="current-month"></h2>
    </div>
    <div id="calendar"></div>
    <!-- <div id="detailKegiatan">
        <div class="events">My Events</div>
        <ul>
            <li>
            </li>
        </ul>
    </div> -->
    <?php
    if(isset ($_GET['action'])){
        $date = str_replace(")","",(str_replace("(","",(str_replace("'","",$_GET['date']))))); 
        echo "Date : ".$date;
        echo "<br>";

        $sqlDate = date("Y-m-d", strtotime(str_replace('/', '-', $date)));
        echo "SQL Date : ".$sqlDate;
        echo "<br>";
        
    ?>
        <h3>Kegiatan</h3>
        <form method="post" action="calendar-action.php">
            <input type="text" name="date" value="<?php echo $sqlDate ?>">
            <label>Judul</label><input type="text" name="judul">
            <label>Kegiatan</label><input type="text" name="kegiatan">

            <button type="submit">Tambah Kegiatan</button>
        </form>
    <?php
    }
    ?>

    <script>
        function generateCalendar(year, month) {
            var startDate = new Date(year, month, 1);
            var endDate = new Date(year, month + 1, 0);
            var currentDate = new Date();

            console.log(startDate);
            console.log(endDate);
            console.log(currentDate);

            var calendarHTML = '<table>' +
                '<tr>' +
                '<th>Sun</th>' +
                '<th>Mon</th>' +
                '<th>Tue</th>' +
                '<th>Wed</th>' +
                '<th>Thu</th>' +
                '<th>Fri</th>' +
                '<th>Sat</th>' +
                '</tr>';

            // Fill in the days
            var dayCount = 1;
            var rowHTML = '<tr>';
            for (var i = 0; i < startDate.getDay(); i++) {
                rowHTML += '<td></td>';
            }
            for (var day = 1; day <= endDate.getDate(); day++) {
                rowHTML += '<td';
                if (year === currentDate.getFullYear() && month === currentDate.getMonth() && day === currentDate.getDate()) {
                    rowHTML += ' class="current-day"';
                }
                
                // ngelink ke form kinan yg add dan update
                rowHTML += '><a href="calendar.php?action=kegiatan&date=(\'' + day + '/' + (month + 1) + '/' + year + '\')">' + day + '</a></td>';
                if (startDate.getDay() === 6) {
                    calendarHTML += rowHTML + '</tr>';
                    if (dayCount < endDate.getDate()) {
                        rowHTML = '<tr>';
                    } else {
                        rowHTML = '';
                    }
                }
                startDate.setDate(startDate.getDate() + 1);
                dayCount++;
            }
            if (rowHTML !== '') {
                calendarHTML += rowHTML + '</tr>';
            }

            calendarHTML += '</table>';
            return calendarHTML;
        }

        function changeMonth() {
            var selectElement = document.getElementById('month-select');
            var selectedMonth = parseInt(selectElement.value);

            var now = new Date();
            var currentYear = now.getFullYear();

            var calendarDiv = document.getElementById('calendar');
            var calendarTable = document.createElement('table');
            calendarTable.innerHTML = generateCalendar(currentYear, selectedMonth);
            calendarDiv.innerHTML = '';
            calendarDiv.appendChild(calendarTable);

            var currentMonthElement = document.getElementById('current-month');
            var monthName = new Date(currentYear, selectedMonth).toLocaleString('default', { month: 'long' });
            currentMonthElement.textContent = monthName + ' ' + currentYear;
        }

        var now = new Date();

        var calendarDiv = document.getElementById('calendar');
        var calendarTable = document.createElement('table');
        calendarTable.innerHTML = generateCalendar(now.getFullYear(), now.getMonth());
        calendarDiv.appendChild(calendarTable);

        var monthSelectElement = document.getElementById('month-select');
        monthSelectElement.value = now.getMonth().toString();
        
        var currentMonthElement = document.getElementById('current-month');
        currentMonthElement.textContent = now.toLocaleString('default', { month: 'long' }) + ' ' + now.getFullYear();
    </script>
    <footer>
        &#169; UAS Praktikum ProgWeb Kelompok 3
    </footer>
</body>
</html>