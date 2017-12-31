//counter will keep track of which index in the array is shown
var counter = 0;
//array of cards to work with
var displayCount = document.getElementById('displayCount');
displayCount.innerHTML = counter + 1 + "/" + cards.length;
var startWithSide = 'title';

// try to access first card, else set it to just a blank card
try {
	$('#cardDisplay').html(cards[counter][startWithSide]);
} catch(err) {
	$('#cardDisplay').html("Hit the '+' to add a card.");
}

//user interaction with cards through button clicks

$('#nextCard').click(function() {
	//call incrementCard when button is clicked
	incrementCard();
});

$('#previousCard').click(function() {
	//call decrementcard when button is clicked
	decrementCard();
});
	
$('#flipCard').click(function() {
	//call flipCard when button is clicked
	flipCard();
});

//user interaction with cards through arrow keys
$(document).keydown(function(e) {
	if (e.key == "ArrowRight") {
		incrementCard();
	} else if (e.key == "ArrowUp") {
		flipCard();
	} else if (e.key == "ArrowLeft") {
		decrementCard();
	} else if (e.key == "ArrowDown") {
		flipCard();
	} else if (e.key == "Enter") {
		flipNewCard();
	}
});

/*
* Shuffle the deck using my implementation of the Fisher-Yates shuffle
* on an array
*/
$('#shuffle').click(function() {
	var backIndex = cards.length-1;
	while (backIndex > 0) {
		var randomIndex = Math.floor(Math.random() * backIndex);
		var temp = cards[backIndex];
		cards[backIndex] = cards[randomIndex];
		cards[randomIndex] = temp;
		backIndex--;
	}
	counter = 0;
	$('#cardDisplay').html(cards[counter][startWithSide]);
	displayCount.innerHTML = counter + 1 + "/" + cards.length;
});

$('#newCard').click(function() {
	/*
	* slide both divs to the right simulaneously
	*/
	$('#newCardDiv').css('display', 'block');
	$('#newCardForm').css('display', 'block');
	$('#definitionInput').css('display', 'none');
	$('#addCard').css('display', 'none');
	$('#card').animate({
		marginLeft: "80%",
		opacity: 0,
	}, 600, function() {
		$('#card').css('display', 'none');
		$('#definitionInput').css('display', 'none');
		$('#addCard').css('display', 'none');
		$('#titleInput').focus();
	});
	$('#newCardDiv').animate({
		marginLeft: '25%',
		opacity: 1, 
	}, 600, function() {
		$('#titleInput').focus();
	});
});

/*
* Toggle the starting view of cards as title side or definition side
*/
$('#studyOppositeSide').click(function() {
	if (startWithSide == 'title') {
		startWithSide = 'definition';
		$('#studyOppositeSide').html("Title First");
	} else {
		startWithSide = 'title';
		$('#studyOppositeSide').html("Definition First");
	}
	$(topCard + 'Display').html(cards[counter][startWithSide]);
});

function incrementCard() {
	/*
	* Change display to the next card in the current set. Animation works by displaying
	* a 'fake' copy of #card on top of #card, and then sliding the fake one off to 
	* reveal the updated text on #card
	*/

	//copy #card's html to make it appear identical
	$('#altCardDisplay').html($('#cardDisplay').html());
	$('#altCard').css('display', 'block');
	//stop and current animation and set properties back to normal in case animation is currently running
	$('#altCard').stop(true);
	$('#altCard').css('margin-left', '25%');
	$('#altCard').css('opacity', '1');	

	//increment text next value in array
	try {
		$('#cardDisplay').html(cards[++counter][startWithSide]);
	} catch(err) {
		counter = 0;
		$('#cardDisplay').html(cards[counter][startWithSide]);
	}

	//update display counter
	displayCount.innerHTML = counter + 1 + "/" + cards.length;

	//slide 25% right and bring down opacity
	$('#altCard').animate({
		marginLeft: '50%',
		opacity: '0'
	}, 300, function() {
		//hide the fake card, and put it back to it's resting spot
		$('#altCard').css('display', 'none');	
		$('#altCard').css('margin-left', '25%');
		$('#altCard').css('opacity', '1');		
	});		

}

function decrementCard() {
	/* 
	* Change display to the previous card in the current set. Animation works by making #altCard
	* into the display of the previous card (the one we want #card to show). Then it is moved to the
	* right of #card, and slid on top of it. Once it is on top, #cardDisplay is updated, and
	* #altCard's display is set back to none
	*/ 

	//update #altCard's value to the previous card
	try {
		$('#altCardDisplay').html(cards[--counter][startWithSide])
	} catch (err) { 
		counter = cards.length-1;
		$('#altCardDisplay').html(cards[counter][startWithSide])
	}

	//stop and finish any animations on #altCard, then move and show it
	$('#altCard').stop(true, true);
	$('#altCard').css('margin-left', '50%');
	$('#altCard').css('opacity', '0');
	$('#altCard').css('display', 'block');

	//sliding animation
	$('#altCard').animate({
		marginLeft: '25%',
		opacity: '1'
	}, 300, function() {
		//make #card into a copy of #altCard, then remove #altCard
		$('#cardDisplay').html($('#altCardDisplay').html());
		$('#altCard').css('display', 'none');
	})

	//update display
	displayCount.innerHTML = counter + 1 + "/" + cards.length;
}

function flipCard() {
	/*
	* Toggle which side of the card is displayed
	*/

	//need to hide bottom card for animation
	$('#card').animate({
		width: '0',
		marginLeft: '50%',
		opacity: 0.2,
	}, 100, function() {
		if ($('#cardDisplay').html() == cards[counter]['title']) {
			$('#cardDisplay').html(cards[counter]['definition']);
		} else {
			$('#cardDisplay').html(cards[counter]['title']);
		}
		$('#card').animate({
			width: '50%',
			marginLeft: '25%',
			opacity: 1
		}, 100, function() {

		})
	});
	
}

function flipNewCard() {
	
	$('#newCardDiv').animate({
		width: '0',
		marginLeft: '50%',
		opacity: 0.2,
	}, 100, function() {
		$('#titleInput').css('display', 'none');
		$('#definitionInput').css('display', 'block');
		$('#titleInputCopy').val($('#titleInput').val());
		$('#newCardDiv').animate({
			width: '50%',
			marginLeft: '25%',
			opacity: 1
	}, 100, function() {
		$('#definitionInput').focus();
	})

	});
}
