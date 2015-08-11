<!DOCTYPE html>
<html lang="no">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Oppgave – kviss</title>
	<link rel="stylesheet" href="../../css/chapmenu.css" />
	<link rel="stylesheet" href="../../css/layout_oppgaver.css" />
	<style>
		body {
			font-family: Arial, sans-serif;
		}
		
		.quiz {
			font-size: 1em;
			counter-reset: quizcounter;
		}
		
		.quiz li:before {
			content: counter(quizcounter);
			counter-increment: quizcounter;
			position: absolute;
			font-size: 2em;
			width: 1.5em;
			font-weight: normal;
			margin-right: 0.125em;
			box-sizing: border-box;
			padding-right: .4rem;
			text-align: right;
			top: auto;
			bottom: auto;
			right: 100%;
			height: 4em;
			line-height: 4em;
			color: gray;
		}
		
		.quiz label {
			display: inline-block;
			border: 2px solid #ccc;
			line-height: 1.75em;
			padding: 0 .5em;
			box-sizing: border-box;
			float: left;
			min-width: 6em;
		}
		
		.quiz label input[type="radio"] {
			margin-right: 1em;
		}
		
		.quiz label + label {
			margin-left: 1em;
			/*margin-top: .5em;*/
		}
		
		.explanation h3 {
			font-family: Arial, sans-serif;
			font-size: 1em;
			color: gray;
		}
		
		.incorrect label[data-incorrect],
		.correct label[data-correct] {
			border-color: gray;
			box-shadow: 0 0 5px #999;
		}
		
		input[type=button],
		button {
			margin: .5em 0;
			min-width: 13em;
			font-size: 1em;
			padding: .25em .5em;
			/*margin-top: .5em;*/
		}
		
		input[type=button].check_answer,
		button.check_answer {
			float: left;
			clear: left;
		}
		
		.quiz li {
			border: 1px solid gray;
			padding: 0 1em;
			margin: 0;
			margin-left: 2.5em;
			border-radius: .5em;
			background: white;
			position: relative;
		}
		
		.quiz li+li {
			margin-top: 1em;
		}
		
		.quiz ol {
			list-style-type: none;
			padding: 0;
		}
		
		.quiz fieldset {
			background: #f8f5f2;
			border-radius: .5em;
		}
		
		.quiz fieldset + fieldset {
			margin-top: 1.5em;
		}
		
		.quiz section {
			float: left;
			width: 13em;
			margin-right: -13em;
		}
		
		.quiz section + section {
			width: auto;
			margin-left: 14em;
			margin-right: 1em;
		}
		
		.quiz li:after {
			content: "";
			display: block;
			clear: both;
			height: 0;
		}
		
		.quiz p {
			/*margin: 0;*/
		}
		
		.quiz legend {
			font-weight: bold;
			text-align: center;
			font-size: 1.5em;
		}
		
		.quiz label.status_correct,
		.quiz label.status_incorrect {
			position: relative;
		}
		
		.quiz label.status_correct {}
		
		.quiz label.status_incorrect {
			border-color: crimson;
		}
		
		.show_result input[type="radio"] {
			visibility: hidden;
		}
		
		.show_result.correct label[data-correct] {
			border-color: limegreen;
		}
		
		.show_result.incorrect label[data-incorrect] {
			border-color: crimson;
		}
		
		.explanation [data-incorrect] span,
		.explanation [data-correct] span {
			font-weight: bold;
		}
		
		.explanation [data-incorrect] span {
			color: crimson;
		}
		
		.explanation [data-correct] span {
			color: limegreen;
		}
		
		.show_result label {
			position: relative;
		}
		
		.show_result.correct label[data-correct]:after,
		.show_result.incorrect label[data-incorrect]:after {
			position: absolute;
			left: -.3em;
			text-align: center;
			content: "✓";
			color: limegreen;
			font-weight: bold;
			margin-left: 1em;
			float: right;
		}
		
		.show_result.incorrect label[data-incorrect]:after {
			content: "✖";
			color: crimson;
		}
		
		.quiz label:hover,
		.quiz label:focus {
			display: block;
			border: 2px solid #0873f0;
		}
		
		.show_result label:hover,
		.show_result label:focus {
			border-color: #ccc;
		}
		
		.quiz .explanation {
			visibility: hidden;
			line-height: 1.5em;
		}
		
		.quiz .explanation [data-incorrect] {
			display: none;
		}
		
		.quiz .show_result.incorrect .explanation,
		.quiz .show_result.correct .explanation {
			visibility: visible;
		}
		
		.quiz .show_result.correct .explanation [data-correct] {
			display: block;
		}
		
		.quiz .show_result.incorrect .explanation [data-correct] {
			display: none;
		}
		
		.quiz .show_result.correct .explanation [data-incorrect] {
			display: none;
		}
		
		.quiz .show_result.incorrect .explanation [data-incorrect] {
			display: block;
		}
		
		.explanation em {
			font-weight: bold;
			font-style: italic;
			text-decoration: none;
		}
		
		fieldset legend + p {
			font-size: 1.5em;
			/*text-align: center;*/
			
			margin-left: 1.75em;
		}
	</style>
	<!--<script src="../js/classmod.js" />-->
</head>

<body>
	<h1>Oppgaver til elevene – kviss</h1>
	<?php $folder_level=1; include "../phpinclude/chapmenu.php";?>
	<?php include "toc.php"; ?>
	<main>
		<h2 id="kviss">Kviss</h2>
		<img src="../graphics/meitemark01.png" alt="en meitemark" />
		<p>Kviss for deg som har studert og lest om meitemark</p>
		<form class="quiz" id="quiz01">

			<fieldset>
				<legend>Meitemarken</legend>
				<p>Hva er sant om meitemarken?</p>
				<ol>
					<li>
						<section>
							<p class="q">Har meitemarken øyne?</p>
							<label for="earthworm_has_eyes_yes" data-incorrect="data-incorrect">
								<input type="radio" id="earthworm_has_eyes_yes" name="earthworm_has_eyes" />Ja</label>
							<label for="earthworm_has_eyes_no" data-correct="data-correct">
								<input type="radio" id="earthworm_has_eyes_no" name="earthworm_has_eyes" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Meitemarken har ikke øyne, men den merker lys og mørke og kjenner at noe nærmer seg.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Meitemarken har ikke øyne, men den merker lys og mørke og kjenner at noe nærmer seg.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">Har meitemarken nese?</p>
							<label for="earthworm_has_nose_yes" data-incorrect="data-incorrect">
								<input type="radio" id="earthworm_has_nose_yes" name="earthworm_has_nose" />Ja</label>
							<label for="earthworm_has_nose_no" data-correct="data-correct">
								<input type="radio" id="earthworm_has_nose_no" name="earthworm_has_nose" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Meitemarken har hverken nese, øyne eller ører. Men den merker lys og mørke og kjenner at noe nærmer seg.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Meitemarken har ikke nese, men den merker lys og mørke og kjenner at noe nærmer seg.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">Har meitemarken føtter?</p>
							<label for="earthworm_has_feet_yes" data-incorrect="data-incorrect">
								<input type="radio" id="earthworm_has_feet_yes" name="earthworm_has_feet" />Ja</label>
							<label for="earthworm_has_feet_no" data-correct="data-correct">
								<input type="radio" id="earthworm_has_feet_no" name="earthworm_has_feet" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Meitemarken har ikke føtter, men børster som den bruker som bein.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Meitemarken har ikke føtter, men børster som den bruker som bein.</p>
						</section>
					</li>
				</ol>
			</fieldset>

			<fieldset>
				<legend>Skolopender</legend>
				<p>Hva er sant om skolopenderen?</p>
				<ol>
					<li>
						<section>
							<p class="q">Skolopender er en pen katt</p>
							<label for="caterpillar_is_a_cat_yes" data-incorrect="data-incorrect">
								<input type="radio" id="caterpillar_is_a_cat_yes" name="caterpillar_is_a_cat" />Ja</label>
							<label for="caterpillar_is_a_cat_no" data-correct="data-correct">
								<input type="radio" id="caterpillar_is_a_cat_no" name="caterpillar_is_a_cat" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Ordet «pen» kan vi finne i skolo<em>pen</em>der, men det har ingenting med pen å gjøre. </p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Ordet «pen» kan vi finne i skolo<em>pen</em>der, men det har ingenting med pen å gjøre.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">Skolopender er en skole?</p>
							<label for="caterpillar_is_a_school_yes" data-incorrect="data-incorrect">
								<input type="radio" id="caterpillar_is_a_school_yes" name="caterpillar_is_a_school" />Ja</label>
							<label for="caterpillar_is_a_school_no" data-correct="data-correct">
								<input type="radio" id="caterpillar_is_a_school_no" name="caterpillar_is_a_school" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Begynnelsen av ordet <em>skolo</em>pender kan ligne på ordet «skole», men har ingenting med skole å gjøre.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Begynnelsen av ordet <em>skolo</em>pender kan ligne på ordet «skole», men har ingenting med skole å gjøre.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">Skolopender er et dyr?</p>
							<label for="caterpillar_is_an_animal_yes" data-correct="data-correct">
								<input type="radio" id="caterpillar_is_an_animal_yes" name="caterpillar_is_an_animal" />Ja</label>
							<label for="caterpillar_is_an_animal_no" data-incorrect="data-incorrect">
								<input type="radio" id="caterpillar_is_an_animal_no" name="caterpillar_is_an_animal" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> En skolopender er et lite dyr.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> En skolopender er et lite dyr.</p>
						</section>
					</li>
				</ol>
			</fieldset>

			<fieldset>
				<legend>Kokong</legend>
				<p>En kokong er …</p>
				<ol>
					<li>
						<section>
							<p class="q">en konge</p>
							<label for="kokong_is_a_king_yes" data-incorrect="data-incorrect">
								<input type="radio" id="kokong_is_a_king_yes" name="kokong_is_a_king" />Ja</label>
							<label for="kokong_is_a_king_no" data-correct="data-correct">
								<input type="radio" id="kokong_is_a_king_no" name="kokong_is_a_king" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Slutten av ordet ko<em>kong</em> kan ligne på ordet «konge», men har ingenting med konge å gjøre.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Slutten av ordet ko<em>kong</em> kan ligne på ordet «konge», men har ingenting med konge å gjøre.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">en pose med egg</p>
							<label for="kokong_is_a_sack_yes" data-correct="data-correct">
								<input type="radio" id="kokong_is_a_sack_yes" name="kokong_is_a_sack" />Ja</label>
							<label for="kokong_is_a_sack_no" data-incorrect="data-incorrect">
								<input type="radio" id="kokong_is_a_sack_no" name="kokong_is_a_sack" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> En kokong er posen som marken spinner rundt eggene sine.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> En kokong er posen som marken spinner rundt eggene sine.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">en fugl som sier ko–ko</p>
							<label for="kokong_is_a_bird_yes" data-incorrect="data-incorrect">
								<input type="radio" id="kokong_is_a_bird_yes" name="kokong_is_a_bird" />Ja</label>
							<label for="kokong_is_a_bird_no" data-correct="data-correct">
								<input type="radio" id="kokong_is_a_bird_no" name="kokong_is_a_bird" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Begynnelsen av ordet <strong>koko</strong>ng kan ligne på «ko-ko», men har ingenting med ko-ko å gjøre.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Begynnelsen av ordete <strong>koko</strong>ng kan ligne på «ko-ko», men har ingenting med «ko-ko» å gjøre.</p>
						</section>
					</li>
				</ol>
			</fieldset>

			<fieldset>
				<legend>Observere</legend>
				<p>Å observere er …</p>
				<ol>
					<li>
						<section>
							<p class="q">å løpe fort</p>
							<label for="observing_is_running_yes" data-incorrect="data-incorrect">
								<input type="radio" id="observing_is_running_yes" name="observing_is_running" />Ja</label>
							<label for="observing_is_running_no" data-correct="data-correct">
								<input type="radio" id="observing_is_running_no" name="observing_is_running" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Å løpe fort er ikke det samme som å observere.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Å løpe fort er ikke det samme som å observere.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">å legge merke til noe</p>
							<label for="observing_is_noticing_yes" data-correct="data-correct">
								<input type="radio" id="observing_is_noticing_yes" name="observing_is_noticing" />Ja</label>
							<label for="observing_is_noticing_no" data-incorrect="data-incorrect">
								<input type="radio" id="observing_is_noticing_no" name="observing_is_noticing" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Å observere er å legge merke til noe ved bruk av sansene.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Å observere er å legge merke til noe ved bruk av sansene.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">å servere mat</p>
							<label for="observing_is_serving_yes" data-incorrect="data-incorrect">
								<input type="radio" id="observing_is_serving_yes" name="observing_is_serving" />Ja</label>
							<label for="observing_is_serving_no" data-correct="data-correct">
								<input type="radio" id="observing_is_serving_no" name="observing_is_serving" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Slutten av ordet ob<em>servere</em> ligner på ordet «servere», men har ikke noe med servere å gjøre.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Slutten av ordet ob<em>servere</em> ligner på ordet «servere», men har ikke noe med servere å gjøre. </p>
						</section>
					</li>
				</ol>
			</fieldset>

			<fieldset>
				<legend>Undersøke</legend>
				<p>Å undersøke er …</p>
				<ol>
					<li>
						<section>
							<p class="q">å lete etter svar</p>
							<label for="investigating_is_finding_answers_yes" data-correct="data-correct">
								<input type="radio" id="investigating_is_finding_answers_yes" name="investigating_is_finding_answers" />Ja</label>
							<label for="investigating_is_finding_answers_no" data-incorrect="data-incorrect">
								<input type="radio" id="investigating_is_finding_answers_no" name="investigating_is_finding_answers" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Å undersøke er å studere eller prøve å finne ut mer om noe.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Å undersøke er å studere eller prøve å finne ut mer om noe.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">å lete under noe</p>
							<label for="investigating_is_looking_below_yes" data-incorrect="data-incorrect">
								<input type="radio" id="investigating_is_looking_below_yes" name="investigating_is_looking_below" />Ja</label>
							<label for="investigating_is_looking_below_no" data-correct="data-correct">
								<input type="radio" id="investigating_is_looking_below_no" name="investigating_is_looking_below" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Man trenger ikke å lete <em>under</em> noe for å undersøke.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Man trenger ikke å lete <em>under</em> noe for å undersøke.</p>
						</section>
					</li>
					<li>
						<section>
							<p class="q">å krype i jorda</p>
							<label for="investigating_is_crawling_underground_yes" data-incorrect="data-incorrect">
								<input type="radio" id="investigating_is_crawling_underground_yes" name="investigating_is_crawling_underground" />Ja</label>
							<label for="investigating_is_crawling_underground_no" data-correct="data-correct">
								<input type="radio" id="investigating_is_crawling_underground_no" name="investigating_is_crawling_underground" />Nei</label>
							<button type="button" disabled="disabled" class="check_answer">Sjekk svar</button>
						</section>
						<section class="explanation">
							<h3>Forklaring</h3>
							<p data-correct="data-correct">
								<span>Riktig!</span> Selv om hovedpersonene i denne fortellingen kryper i jorda, så må man ikke det for å undersøke noe.</p>
							<p data-incorrect="data-incorrect">
								<span>Beklager, det er feil.</span> Selv om hovedpersonene i denne fortellingen kryper i jorda, så må man ikke det for å undersøke noe.</p>
						</section>
					</li>
				</ol>
			</fieldset>

			<h2>Resultater</h2>
			<p>Når du svarer på spørsmål oppdateres resultatene dine her</p>
			<p>Du kan prøve så mange ganger du vil. Når du har svart på alle spørsmålene og ser hvor mange du klarte, blir det mulig å starte kvissen på nytt.</p>
			<!--<dl id="results">
				<dt>Antall forsøk</dt>
				<dd id="tries">0</dd>
				<dt>Meitemarken</dt>
				<dd>
					<ul>
						<li>Poeng: <span></span> av <span></span>
						</li>
						<li>Antall ubesvart: <span></span>
						</li>
					</ul>
				</dd>
			</dl>-->
			<button type="button">Sjekk resultater</button>
			<button type="button" disabled>Start på nytt</button>
		</form>
	</main>
	<script src="../../js/classmod.js"></script>
	<script>
		window.addEventListener('load', quizInit, false);
		var check_answer_buttons, radio_inputs;

		function quizInit() {
			console.log('quizInit()');
			check_buttons = document.querySelectorAll('button.check_answer');
			radio_inputs = document.querySelectorAll('input[type=radio]');
			for (var i = 0; i < check_buttons.length; i++) {
				check_buttons[i].addEventListener('click', checkAnswer, false);
			}
			// knappene er i utgangspunktet disabled, men blir enabled når en radio button velges
			for (var j = 0; j < radio_inputs.length; j++) {
				radio_inputs[j].addEventListener('click', selectAnswer, false);
			}
		}

		function checkAnswer(ev) {
			console.log('checkAnswer()');
			var target = ev.target;
			var qsetli = target.parentElement.parentElement;
			var current_set_inputs = qsetli.querySelectorAll('input');
			// sjekk om noen er valgt - dette er nå unødvendig
			// sjekk om rett eller feil svar er valgt
			console.log(qsetli.nodeName);
			console.log(current_set_inputs.length);
			addClass(qsetli, 'show_result');
			// disable all inputs in this question set
			for (i = 0; i < current_set_inputs.length; i++) {
				current_set_inputs[i].setAttribute('disabled', 'disabled');
			}
			target.setAttribute('disabled', 'disabled');
		}

		function selectAnswer(ev) {
			console.log("selectAnswer()");
			var target = ev.target;
			var qsetli = target.parentElement.parentElement.parentElement;
			var check_current_answer_button = target.parentElement.parentElement.querySelector('button.check_answer');
			//activate check answer button
			check_current_answer_button.removeAttribute('disabled');

			// this is run on input type = radio button

			if (target.parentElement.getAttribute('data-correct') !== null) {
				// console.log("this is the correct answer");
				// console.log(qsetli.nodeName);
				removeClass(qsetli, 'incorrect');
				addClass(qsetli, 'correct');


			} else if (target.parentElement.getAttribute('data-incorrect') !== null) {
				// console.log("this is the incorrect answer");
				// console.log(qsetli.nodeName);
				removeClass(qsetli, 'correct');
				addClass(qsetli, 'incorrect');
			}
		}
	</script>
</body>

</html>