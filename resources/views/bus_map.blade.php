
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bus Seat Selection - 44 Seater</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 20px;
    font-family: Arial, sans-serif;
    background: #f3f5f9;
    color: #222;
}

.container {
    max-width: 850px;
    margin: auto;
}

h2 {
    text-align: center;
    color: #123c75;
}

.bus-wrapper {
    max-width: 570px;
    margin: 20px auto;
    padding: 20px;
    background: white;
    border: 5px solid #333;
    border-radius: 85px 85px 35px 35px;
}

.driver {
    background: #354e70;
    color: white;
    border-radius: 30px 30px 10px 10px;
    padding: 30px 10px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 25px;
}

.steering {
    text-align: right;
    font-size: 30px;
    margin: -15px 20px 15px;
}

.seats {
    display: grid;
    grid-template-columns: 1fr 1fr 55px 1fr 1fr;
    gap: 12px 8px;
}

.seat {
    min-width: 0;
    height: 57px;
    border: 2px solid #0759b2;
    border-radius: 13px;
    background: linear-gradient(145deg,#1688f5,#0752b4);
    color: white;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    box-shadow: 0 3px 4px #aaa;
}

.seat:hover:not(.booked) {
    transform: scale(1.04);
}

.seat.selected {
    background: #20ad50;
    border-color: #11833b;
}

.seat.booked {
    background: #ed2525;
    border-color: #bd1010;
    cursor: not-allowed;
}

.aisle {
    grid-column: 3;
}

.rear {
    background: #555;
    color: white;
    text-align: center;
    font-weight: bold;
    padding: 18px;
    margin-top: 25px;
    border-radius: 5px;
}

.legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin: 20px 0;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 14px;
}

.color-box {
    width: 20px;
    height: 20px;
    border-radius: 5px;
}

.summary {
    max-width: 570px;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px #ddd;
}

.summary p {
    margin: 12px 0;
}

.book-btn {
    width: 100%;
    padding: 14px;
    border: 0;
    background: #087c3b;
    color: white;
    font-size: 17px;
    border-radius: 6px;
    cursor: pointer;
}

.book-btn:disabled {
    background: #999;
    cursor: not-allowed;
}

@media(max-width: 480px) {
    body {
        padding: 8px;
    }

    .bus-wrapper {
        padding: 12px;
        border-width: 3px;
        border-radius: 45px 45px 20px 20px;
    }

    .seats {
        grid-template-columns: 1fr 1fr 24px 1fr 1fr;
        gap: 9px 5px;
    }

    .seat {
        height: 45px;
        font-size: 15px;
        border-radius: 9px;
    }

    .driver {
        padding: 20px 5px;
        font-size: 18px;
    }
}
</style>
</head>

<body>

<div class="container">

<h2>Tata Bus - 44 Seats (Normal Seater)</h2>

<div class="legend">
    <div class="legend-item">
        <span class="color-box" style="background:#0875dc"></span>
        Available
    </div>

    <div class="legend-item">
        <span class="color-box" style="background:#20ad50"></span>
        Selected
    </div>

    <div class="legend-item">
        <span class="color-box" style="background:#ed2525"></span>
        Booked
    </div>
</div>

<div class="bus-wrapper">

    <div class="driver">
        DRIVER CABIN
    </div>

    <div class="steering">◉</div>

    <div class="seats" id="seatLayout"></div>

    <div class="rear">
        REAR EXIT
    </div>

</div>

<div class="summary">

    <h3>Booking Summary</h3>

    <p>
        <strong>Selected Seats:</strong>
        <span id="selectedSeats">None</span>
    </p>

    <p>
        <strong>Total Seats:</strong>
        <span id="totalSeats">0</span>
    </p>

    <p>
        <strong>Fare Per Seat:</strong>
        ₹<span id="fare">450</span>
    </p>

    <h3>
        Total Amount: ₹<span id="totalAmount">0</span>
    </h3>

    <button class="book-btn" id="bookBtn" disabled>
        Continue Booking
    </button>

</div>

</div>

<script>

// Configuration
const farePerSeat = 450;

// Demo booked seats
// Replace this array with Laravel database data.
const bookedSeats = [
    2, 5, 8, 12, 17, 23, 28, 35, 41
];

let selectedSeats = [];

const layout = document.getElementById('seatLayout');

// Generate 11 rows
for (let row = 0; row < 11; row++) {

    const left1 = (row * 2) + 1;
    const left2 = (row * 2) + 2;

    const right1 = 23 + (row * 2);
    const right2 = 24 + (row * 2);

    [left1, left2, null, right1, right2]
        .forEach(seatNumber => {

            if (seatNumber === null) {
                const aisle = document.createElement('div');
                aisle.className = 'aisle';
                layout.appendChild(aisle);
                return;
            }

            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'seat';
            button.textContent = seatNumber;

            button.dataset.seat = seatNumber;

            if (bookedSeats.includes(seatNumber)) {
                button.classList.add('booked');
                button.disabled = true;
            }

            button.addEventListener('click', function() {
                selectSeat(seatNumber, button);
            });

            layout.appendChild(button);
        });
}

// Select / deselect seats
function selectSeat(seatNumber, button) {

    if (selectedSeats.includes(seatNumber)) {

        selectedSeats = selectedSeats.filter(
            seat => seat !== seatNumber
        );

        button.classList.remove('selected');

    } else {

        selectedSeats.push(seatNumber);

        button.classList.add('selected');
    }

    updateSummary();
}

// Update booking summary
function updateSummary() {

    selectedSeats.sort((a, b) => a - b);

    document.getElementById('selectedSeats').textContent =
        selectedSeats.length
            ? selectedSeats.join(', ')
            : 'None';

    document.getElementById('totalSeats').textContent =
        selectedSeats.length;

    document.getElementById('fare').textContent =
        farePerSeat;

    document.getElementById('totalAmount').textContent =
        selectedSeats.length * farePerSeat;

    document.getElementById('bookBtn').disabled =
        selectedSeats.length === 0;
}

// Continue booking
document.getElementById('bookBtn').addEventListener('click', function() {

    alert(
        'Selected Seats: ' + selectedSeats.join(', ') +
        '\nTotal Amount: ₹' +
        (selectedSeats.length * farePerSeat)
    );

});

</script>

</body>
</html>
