<!DOCTYPE html> 
<html lang="en">
  <head>
    <Meta charset="UTF-8"
      <Meta name="viewport", content="width=device-width, height="device-height", initial-scale="1.0">
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
    </style>
  </head>

<section>
        <h1><center>uOttawa NightLife Reviews</center></h1>
</section>
<body>
<body>
    <?php require_once '../includes/navbar.php'; ?>
    <!-- rest of your page content -->

      <div class="bg">
    <header>
    </div>


<center>    
        <section>
            <h2>Submit Your Review</h2>
                <form action="ratingsreviews_Sql.php" method="post">
                <label for="business">Business:</label>
                <input type="text" id="business" name="business" required>
                
                <label for="review-rating">★★★★★:</label>
                <select id="review-rating" name="review-rating" required>
                    <option value="1">★☆☆☆☆</option>
                    <option value="2">★★☆☆☆</option>
                    <option value="3">★★★☆☆</option>
                    <option value="4">★★★★☆</option>
                    <option value="5">★★★★★</option>
                </select>
                
                <label for="description">Review:</label>
                <textarea id="description" name="description" " required></textarea>
                <button type="submit">Submit</button>
            </form>
        </section>   
</center>

  

<div class="review">
    <h3><b>Happy Fish</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Dancing</p>
    <p>"Great spot but way too full for the size of the place most times"</p>
    <p>Price: $$ - $$$</p>
</div>


<div class="review">
    <h3><b>Heart & Crown</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Fireplace</p>
    <p>"Enjoyed the live music here on a Sunday. Prices are a bit high for a pub, but the cocktails we ordered all tasted great."</p>
    <p>Price: $$ - $$$</p>
</div>


<div class="review">
    <h3><b>Lieutenant's Pump</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Trivia Night</p>
    <p>"Classic Brit-Canadian pub. It's much larger than it looks from the outside. Very dark inside but friendly atmosphere. Good pub fare and great pints."</p>
    <p>Price: $$ - $$$</p>
</div>

  <div class="review">
    <h3><b>El Furniture warehouse</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Happy hour food, Great cocktails, Doesn't accept reservations</p>
    <p>"Nice place to have some drinks and hang out. Prices are decent. Only negative was the Food was alright at best."</p>
    <p>Price: $ </p>
</div>

    <div class="review">
    <h3><b>The Nelson Pub & Eatery</b></h3>
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Good for watching sports, Wi-Fi</p>
    <p>"I love this place. The service is great, menu is affordable, and the drinks are delicious. Food is solid too!"</p>
    <p>Price: $$</p>
</div>

      <div class="review">
    <h3><b>Pub 101</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Easygoing bar, TVs, Patio, Karaoke</p>
    <p>"The prices are excellent, and portions are perfect, not giant, not too small. The atmosphere is excellent with nice live music on some nights. It's 3 floors and fun."</p>
    <p>Price: $$</p>
</div>

        <div class="review">
    <h3><b>Lowertown Brewery, Byward Market</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Outdoor seating, Great cocktails, Vegetarian Options</p>
    <p>"Had a blast at Lowertown! Went with some friends for drinks and a hot pretzel. Fun atmosphere."</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review">
    <h3><b>The Senate Tavern on Clarencet</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Cozy, Sports-themed, Canadian pub grub & draft beers</p>
    <p>"Great beer selection. Love the craft. Beer amazing. Washroom very clean."</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review">
    <h3><b>Level One Game Pub</b></h3>
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Vegan options, Live music</p>
    <p>"The atmosphere here is awesome! This place has a great selection of board games and video games too! The staff here are very friendly and the drinks and food are super tasty. Lots of space in the venue as well for activities.
"</p>
    <p>Price: $$ - $$$</p>
</div>
  
          <div class="review">
    <h3><b>House of TARG</b></h3>
    <p>Rating: ★★★★★</p>
    <p>Great cocktails, Live performances, Dancing</p>
    <p>"Targ is always a great time. The atmosphere is lively and casual. If you go early on the free-play days, there are lots of machines available, although it gets busy as the day goes on. The staff is always friendly and helpful. The pinball machines are well maintained and there is a great variety of games from all different points in time. Don't forget to try their famous pierogies, which never disappoint!".</p>
    <p>Price: $$ - $$$</p>
</div>

          <div class="review">
    <h3><b>Hangout</b></h3>
    <p>Rating: </p>
    <p>Bubble Tea, Shaved Ice, & Brick Toasts with board and arcade games</p>
    <p>"This is a really interesting, and AFFORDABLE, place to hang out. I love the intersection of niches that are found here:  boardgames, ramen, and bumble tea :)"</p>
    <p>Price: $</p>
</div>


          <div class="review">
    <h3><b>The Gilmour</b></h3>
    <p>Rating: ★★★★★</p>
    <p>Outdoor seating, Great cocktails, Live music</p>
    <p>"Good for bar food, decent drink options. Lots of board games. Fun 80s/90s Playlist."</p>
    <p>Price: $$</p>
</div>  

            <div class="review">
    <h3><b>Manor Lounge</b></h3>
    <p>Rating: ★★★★☆</p>
    <p>Happy hour food, Great cocktails, Vegan options</p>
    <p>"Great concept combining restaurant, dart, escape room and boardgames. We enjoyed oue time. Food is ok, pub quality but the ambience and people are friendly. Recommend visiting."</p>
    <p>Price: $$</p>
</div>  

  </body>
</html>
  
