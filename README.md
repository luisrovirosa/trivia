# PHP Refactoring
## Objective
1. Map real objects with code classes.
2. Improve legibility.
3. Reduce cyclomatic complexity.

## Side effects 
1. Finding bugs:
    1. Typo in messages
    2. When a player go to penalty box it always have the behavior this user is always marked as in penalty box.
    3. A user answer a question event if it's have not been made. Workflow: User go to penalty box, in the next turn don't leave penalty box, the question is not made, but the user answer incorrectly. Execution example:
        - Chet is the current player
		- They have rolled a 2
		- Chet is not getting out of the penalty box
		- Question was incorrectly answered
		- Chet was sent to the penalty box 

## Classes after refactor

- GameRunner: Starts and ends the game.
- Game:
	- Holds the players, the board and the Messages.
	- Handle the roll, know when the game is ended, and send the messages.
- Board: Handle the Positions and prepare the Categories and their questions.
- Players: Creates the players and holds the current player.
- Messages: Send to write the messages.
- Position: Holds the position information.
- Category: Handle the questions.
- Question: Holds the question information.
- Player: Holds the player information.
- Output namespace: Write the messages.
	- Output: Definition of an output (Interface).
	- Console: The normal output.
	- File: The output used for testing.

## Metrics of Original solution

###Lines of code
- Total: 205
- Comment lines of code: 0
- Logical lines of code: 99
- Average classe length: 88
- Average method length: 7

###Cyclomatic Complexity
- Average per LLOC: 0.25
- Average per class: 25.00
- Average per method: 3.18

## Metrics Refactored solution
###Lines of code
- Total: 746
- Comment lines of code: 176 (All PHPDoc)
- Logical lines of code: 153
- Average classe length: 11
- Average method length: 1

###Cyclomatic Complexity
- Average per LLOC: 0.06
- Average per class: 1.75
- Average per method: 1.12

## How to run the kata

1. Instalar [composer](https://getcomposer.org/) `curl -sS https://getcomposer.org/installer | php`
2. `composer install` (estando en la carpeta php)
3. `./vendor/bin/phpunit`