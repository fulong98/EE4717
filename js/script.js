const container = document.querySelector('.seat-container');
const seats = document.querySelectorAll('.row .seat:not(.occupied)');
const count = document.getElementById('count');
const price = document.getElementById('price');
const selected_seat = document.getElementById('selected_seats');

const movieSelect = document.getElementById('movie').innerHTML;
console.log(movieSelect)
let ticketPrice = +10;

const populateUI = () => {
  const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats'));

  if (selectedSeats !== null && selectedSeats.length > 0) {
    seats.forEach((seat, index) => {
      if (selectedSeats.indexOf(index) > -1) {
        seat.classList.add('selected');
      }
    });
  }

  const selectedMovieIndex = localStorage.getItem('selectedMovieIndex');
  const selectedMoviePrice = localStorage.getItem('selectedMoviePrice');

  if (selectedMovieIndex !== null) {
    movieSelect.selectedIndex = selectedMovieIndex;
  }

  if (selectedMoviePrice !== null) {
    count.innerText = selectedSeats.length;
    price.innerText = selectedSeats.length * +selectedMoviePrice;
  }
};

populateUI();

selectedMovie = (movieIndex, moviePrice) => {
  // localStorage.setItem('selectedMovieIndex', movieIndex);
  localStorage.setItem('selectedMoviePrice', moviePrice);
};

const updateSelectedSeatsCount = () => {
  var seating_str='';
  const selectedSeats = document.querySelectorAll('.row .selected');
  for(let i=0; i<selectedSeats.length; i++)
  {
  console.log(selectedSeats[i].id);
  seating_str = seating_str  + selectedSeats[i].id +',';
  }
  const seatsIndex = [...selectedSeats].map(seat => [...seats].indexOf(seat));
  console.log(seatsIndex)
  // localStorage.setItem('selectedSeats', JSON.stringify(seatsIndex));

  const selectedSeatsCount = selectedSeats.length;

  count.innerText = selectedSeatsCount;
  price.innerText = selectedSeatsCount * ticketPrice;
  selected_seat.value = seating_str;
};

// Seat select event
container.addEventListener('click', e => {
  if (
    e.target.classList.contains('seat') &&
    !e.target.classList.contains('occupied')
  ) {
    e.target.classList.toggle('selected');

    updateSelectedSeatsCount();
  }
});
