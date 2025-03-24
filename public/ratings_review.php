  <!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> uOttawa NightLife </title>
  <style>
body {
        font-family: 'Poppins', sans-serif; 
        margin: 0;
        padding: 0;
        background-color: #E6F0FA;
        color: #222;
    }
    
header {
        background-color: #09223b; 
        color: #cbd1d6;
        padding: 10px 0;
        text-align: center;
        }

section {
    padding: 20px;
    line-height: 1.4;
    background-color: #878a8c;
    margin: 20px;
}
    
.login-btn {
    background-color: #0b6aa0;
    color: #ffffff;
    padding: 10px 20px; 
    border-radius: 5px; 
    font-family: 'Poppins', sans-serif;
} 
.review {
    padding: 10px;
    background-color: #edeff0;
    border-radius: 5px;
    margin: 20px;
}
sortOptions {
    text-align: center;
    background-color:#878a8c;
    border-radius: 5px;
    margin: 20px;
}
    </style>
  </head>

<body>
<?php
require_once '../includes/session.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
?>
    <?php require_once '../includes/navbar.php'; ?>
    <link rel="stylesheet" href="assets/styles.css">



<section>
            <h1><center>uOttawa NightLife Reviews</center></h1>
</section>

<div id="sortOptions">
    <select id="sortFilter">
        <option value="Chronological">Chronological Order</option>
        <option value="Alphabetical">Alphabetical Order</option>
        <option value="Ratings">Ratings-Based Order</option>
    </select>
</div>

<div id="nightlifeReviews">  
  <div class="review" data-add-date="2025-03-01" data-rating="3.7">
    <h1><b>Happy Fish</b></h1> 
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Dancing</p>
    <p>"Great spot but way too full for the size of the place most times"</p>
    <p>Price: $$ - $$$</p>
</div>


<div class="review" data-add-date="2025-03-02" data-rating="4.2">
    <h1><b>Heart & Crown</b></h1> 
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Fireplace</p>
    <p>"Enjoyed the live music here on a Sunday. Prices are a bit high for a pub, but the cocktails we ordered all tasted great."</p>
    <p>Price: $$ - $$$</p>
</div>


<div class="review" data-add-date="2025-03-02" data-rating="4.3">
    <h1><b>Lieutenant's Pump</b></h1> 
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Trivia Night</p>
    <p>"Classic Brit-Canadian pub. It's much larger than it looks from the outside. Very dark inside but friendly atmosphere. Good pub fare and great pints."</p>
    <p>Price: $$ - $$$</p>
</div>

  <div class="review" data-add-date="2025-03-03" data-rating="4.0">
    <h1><b>El Furniture warehouse</b></h1> 
    <p>Rating: ★★★★☆</p>
    <p>Happy hour food, Great cocktails, Doesn't accept reservations</p>
    <p>"Nice place to have some drinks and hang out. Prices are decent. Only negative was the Food was alright at best."</p>
    <p>Price: $ </p>
</div>

    <div class="review" data-add-date="2025-03-04" data-rating="4.7">
    <h1><b>The Nelson Pub & Eatery</b></h1> 
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Good for watching sports, Wi-Fi</p>
    <p>"I love this place. The service is great, menu is affordable, and the drinks are delicious. Food is solid too!"</p>
    <p>Price: $$</p>
</div>

      <div class="review" data-add-date="2025-03-05" data-rating="4.0">
    <h1><b>Pub 101</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Easygoing bar, TVs, Patio, Karaoke</p>
    <p>"The prices are excellent, and portions are perfect, not giant, not too small. The atmosphere is excellent with nice live music on some nights. It's 3 floors and fun."</p>
    <p>Price: $$</p>
</div>

        <div class="review" data-add-date="2025-03-06" data-rating="3.8">
    <h1><b>Lowertown Brewery, Byward Market</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Vegetarian Options</p>
    <p>"Had a blast at Lowertown! Went with some friends for drinks and a hot pretzel. Fun atmosphere."</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review" data-add-date="2025-03-07" data-rating="4.2">
    <h1><b>The Senate Tavern on Clarencet</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Cozy, Sports-themed, Canadian pub grub & draft beers</p>
    <p>"Great beer selection. Love the craft. Beer amazing. Washroom very clean."</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review" data-add-date="2025-03-08" data-rating="4.6">
    <h1><b>Level One Game Pub</b></h1>
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Vegan options, Live music</p>
    <p>"The atmosphere here is awesome! This place has a great selection of board games and video games too! The staff here are very friendly and the drinks and food are super tasty. Lots of space in the venue as well for activities.
"</p>
    <p>Price: $$ - $$$</p>
</div>
  
          <div class="review" data-add-date="2025-03-09" data-rating="4.6">
    <h1><b>House of TARG</b></h1>
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Live performances, Dancing</p>
    <p>"Targ is always a great time. The atmosphere is lively and casual. If you go early on the free-play days, there are lots of machines available, although it gets busy as the day goes on. The staff is always friendly and helpful. The pinball machines are well maintained and there is a great variety of games from all different points in time. Don't forget to try their famous pierogies, which never disappoint!".</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review" data-add-date="2025-03-10" data-rating="4.4">
    <h1><b>Hangout</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Bubble Tea, Shaved Ice, & Brick Toasts with board and arcade games</p>
    <p>"This is a really interesting, and AFFORDABLE, place to hang out. I love the intersection of niches that are found here:  boardgames, ramen, and bumble tea :)"</p>
    <p>Price: $</p>
</div>


          <div class="review" data-add-date="2025-03-10" data-rating="4.8">
    <h1><b>The Gilmour</b></h1>
    <p>Rating: ★★★★★</p>
    <p>Outdoor seating, Great cocktails, Live music</p>
    <p>"Good for bar food, decent drink options. Lots of board games. Fun 80s/90s Playlist."</p>
    <p>Price: $$</p>
</div>  

            <div class="review" data-add-date="2025-03-11" data-rating="4.4">
    <h1><b>Manor Lounge</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Happy hour food, Great cocktails, Vegan options</p>
    <p>"Great concept combining restaurant, dart, escape room and boardgames. We enjoyed oue time. Food is ok, pub quality but the ambience and people are friendly. Recommend visiting."</p>
    <p>Price: $$</p>
</div>  

            <div class="review" data-add-date="2025-03-06" data-rating="3.0">
    <h1><b>Wise Town Cafe</b></h1>
    <p>Rating: ★★★☆☆</p>
    <p>Coffee & Tea, Lounges, Sandwhiches</p>
    <p>"The inside of this cafe is stunning. It is so beautiful. Funky wooden furniture, plants galore, really nice vibe. A great place for a date or to hang out with friends."</p>
    <p>Price: $$</p>
</div>  

            <div class="review" data-add-date="2025-03-07" data-rating="5.0">
    <h1><b>Equator Coffee</b></h1>
    <p>Rating: ★★★★★</p>
    <p>Coffee & Tea</p>
    <p>"Best coffee, great treats, awesome service! It's my favourite place for coffee any day. Also their take out coffee beans are just as amazingly delicious."</p>
    <p>Price: $$</p>
</div>  

          <div class="review" data-add-date="2025-03-02" data-rating="3.3">
    <h1><b>Little Victories Coffee Roasters</b></h1>
    <p>Rating: ★★★☆☆</p>
    <p>Coffee & Tea, Lounges, Coffee Roasteries</p>
    <p>"Great little coffee shop with very friendly service. Quality of coffee is better than many shops in the city."</p>
    <p>Price: $$</p>
</div>  

          <div class="review" data-add-date="2025-03-07" data-rating="4.3">
    <h1><b>Happy Goat Coffee Company</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Coffee & Tea</p>
    <p>"If you're looking for a new place to meet friends for either coffee or a glass of wine, try this cozy, interesting hidden (for now) gem. Fun, funky and relaxed design--not your usual coffee chain experience."</p>
    <p>Price: $$</p>
</div>  

          <div class="review" data-add-date="2025-03-08" data-rating="4.4">
    <h1><b>The Ministry of Coffee</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Coffee & Tea</p>
    <p>"This is a great example of an indie coffee shop. The drinks were great, the ambiance was relaxed. Overall enjoyable."</p>
    <p>Price: $$</p>
</div>  

         <div class="review" data-add-date="2025-03-09" data-rating="4.5">
    <h1><b>Drip House</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Coffee & Tea</p>
    <p>"It's very pretty and spacious inside. Definitely a great cafe to hangout in. I've had a few items from here. Their blueberry muffin ($3.50) was super moist and very tasty. "</p>
    <p>Price: $$$</p>
</div>  

        <div class="review" data-add-date="2025-03-10" data-rating="4.1">
    <h1><b>El Camino</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Coffee & Tea</p>
    <p>"It's very pretty and spacious inside. Definitely a great cafe to hangout it. I've had a few items from here. Their blueberry muffin ($3.50) was super moist and very tasty. "</p>
    <p>Price: $$$</p>
</div>  

          <div class="review" data-add-date="2025-03-10" data-rating="4.5">
    <h1><b>The Brig Pub</b></h1>
    <p>Rating: ★★★★☆</p>
    <p>Pubs, American, Canadian</p>
    <p>"Went to The Brig last night after wandering the neighbourhood looking for somewhere to eat and relax. Totally fit the bill. Food was really tasty"</p>
    <p>Price: $$</p>

</div>  

          <div class="review" data-add-date="2025-03-10" data-rating="3.5">
    <h1><b>Father & Sons</b></h1>
    <p>Rating: ★★★☆☆</p>
    <p>Pubs, Breakfast & Brunch, Canadian</p>
    <p>"This place is perfect for the Ottawa U student, or any student/fun/chill person. The prices are low, casual atmosphere, daily specials, off the beaten path of patio central in the market and lots of drinks."</p>
    <p>Price: $$</p>
</div>  

          <div class="review" data-add-date="2025-03-10" data-rating="3.3">
    <h1><b>The Grand Pizzeria</b></h1>
    <p>Rating: ★★★☆☆</p>
    <p>Italian, Pizza, Bars</p>
    <p>"Overall ambiance was great and good service. The patio was nice and had a relaxing atmosphere in the Byward Market. Great for those who love authentic Italian pizza."</p>
    <p>Price: $$</p>
</div>  

<script>
function getReviews() {
    const reviewElements = document.querySelectorAll(".review");
    return Array.from(reviewElements).map(review => ({
    element: review, 
    name: review.querySelector("h1").textContent,
    date: review.getAttribute("data-add-date"),
    rating: parseFloat(review.getAttribute("data-rating"))
}));
}

function displayReviews(reviews) {
    const list = document.getElementById("nightlifeReviews");
    list.innerHTML = "";
    reviews.forEach(review => list.appendChild(review.element));
}

const comparators = {
  Chronological: (a, b) => new Date(a.date) - new Date(b.date),
  Alphabetical: (a, b) => a.name.localeCompare(b.name),
  Ratings: (a,b) => b.rating - a.rating
};

  function sortReviews(criterion) {
    const reviews = getReviews();
    displayReviews(reviews.sort(comparators[criterion]));
  }

document.getElementById("sortFilter").addEventListener("change", (e) => sortReviews(e.target.value));
displayReviews(getReviews());

    </script>
  </body>
</html>
  
