<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number_people = intval($_POST['number_people']);
    $result = '';

    if (!is_numeric($number_people) || $number_people < 1) {
        $result = 'Input value does not exist or value is invalid';
    } else {
        // Cards setup
        $suits = ['S', 'H', 'D', 'C'];
        $ranks = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];
        $cards = [];

        foreach ($suits as $suit) {
            foreach ($ranks as $rank) {
                $cards[] = $rank . $suit;
            }
        }

        // Shuffle cards
        for ($i = count($cards) - 1; $i > 0; $i--) {
            $j = rand(0, $i);
            [$cards[$i], $cards[$j]] = [$cards[$j], $cards[$i]];
        }

        // Distribute cards to people
        $distribution = [];
        for ($i = 0; $i < $number_people; $i++) {
            $distribution["Person " . ($i + 1)] = array_splice($cards, 0, 52 / $number_people);
        }

        // Prepare result HTML
        foreach ($distribution as $person => $cards) {
            $result .= "<p><strong>$person :</strong> " . implode(', ', $cards) . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- meta -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- end meta -->

  <!-- css -->
  <link rel="stylesheet"  href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
  <!-- end css -->

  <!-- title -->
  <title>Result</title>
  <!-- end title -->

</head>
<body>

  <!-- page result -->
  <div class="page result">

    <!-- container -->
    <div class="container my-3 py-3">
      <h4 class="text-center py-3">Number of People Entered : <?php echo $number_people; ?></h4>
      <div class="d-grid my-2">
        <button id="previous" type="button" name="button" class="btn btn-secondary"><i class="fa-solid fa-chevron-left"></i> Back to Reinput Number</button>
      </div>

    </div>
    <!-- end container -->

    <!-- container -->
    <div class="container">
      <h1 class="text-center">Result</h1>
      <hr>
      <div id="output">
        <?php echo $result; ?>
      </div>
    </div>
    <!-- end container -->

  </div>
  <!-- end page result -->

  <!-- javascript -->
  <script src="script.js"></script>
  <script type="text/javascript">

  var data = checkPage({
    category:'intro',
    page:path.file_name,
  });

  //Get the Page Container
  const container = document.querySelector(data.class_name);

  //Check Container
  if(container){

    //Apply the zoom-in animation class
    container.classList.add('zoom-in');

    //Get Enter Link ID
    const previousLink = document.getElementById('previous');

    //Add Event listener for Enter key press
    document.addEventListener('keydown',function(event){

      //If Keyboard Pressed Enter
      if(event.key === 'Enter'){

        //Remove the "zoom-in" class to trigger the animation
        container.classList.remove('zoom-in');

        //Add the "zoom-out" class to trigger the animation
        container.classList.add('zoom-out');

        //Page Redirect
        redirectPage(data.page_redirect);

      }

    });

    //Add event listener for Enter key press
    previousLink.addEventListener('click',function(event){

      //Prevent the link from navigating
      event.preventDefault();

      //Remove the "zoom-in" class to trigger the animation
      container.classList.remove('zoom-in');
      container.classList.add('zoom-out');

      //Page Redirect
      redirectPage(data.page_redirect);

    });

  }

  </script>
  <!-- end javascript -->

</body>
</html>
