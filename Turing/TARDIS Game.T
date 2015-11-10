%***********************************************************************%
%                                                                       %
%                          Program Header                               %
%                                                                       %
%***********************************************************************%
%***********************************************************************%
%                                                                       %
% PROGRAMMER'S NAME:    George Petrovic                                 %
%                                                                       %
% DATE:                 Tuesday, June 14, 2011                          %
%                                                                       %
% PROGRAM NAME:         Time Lord Dust Catcher                          %
%                                                                       %
% CLASS:                TEJ-201                                         %
%                                                                       %
% ASSIGNMENT:           Summative                                       %
%                                                                       %
% TEACHER:              Mr. Henrich                                     %
%                                                                       %
% DUE DATE:             Tuesday, June 14, 2011                          %
%                                                                       %
%***********************************************************************%
%                                                                       %
% WHAT THE PROGRAM DOES                                                 %
%                                                                       %
% This program is a game in which you choose one of the three           %
% difficulties. Once chosen the desired level, the game will begin,     %
% the objective is to catch the falling stars with a blue block         %
% and finish in the least time possible. The results are recorded       %
% and later given to you at the end. The skills needed to play this game%
% are a good hand - eye - coordination, and the ability to use arrow    %
% keys for movement.                                                    %
%***********************************************************************%
%                                                                       %
% PROCEDURES                                                            %
%                                                                       %
% Two procedures are used within this program:                          %
% Move_Blocker:                                                         %
%                 Allows the user to move the block.                    %
% START:                                                                %
%                 Initiates the start screen.                           %
%***********************************************************************%
%                                                                       %
% EXTENSIONS AND IMPROVEMENTS                                           %
% This program could be improved in a variety of ways:                  %
% 1. Allow user to choose colors to be displayed in the asterisk.       %
% 2. Make the asterisk a different color then the block.                %
%***********************************************************************%




%makes the blocker and the res of the program bright blue.
color (brightblue)
%listing all the constants.
const BLOCKER :=
    chr (219) + chr (219) + chr (219) + chr (219) + chr (219)
const NUMBER_OF_ASTERISKS := 20
const LEFT_ARROW := chr (203)
const RIGHT_ARROW := chr (205)
const HOME := chr (200)
const END := chr (208)
const Blocker_Row := 24
const BLANK_BLOCKER := "      "

%listing all the variables.
var Key : string (1)
var Asterisk_Column, Start, Finish, WAIT, pic1, pic2 : int
var Blocker_Column := 38
var Asterisk_Row := 2
var StartANS, flag, ender : string

%picks out the picture for later use.
pic1 := Pic.FileNew ("river sinking.jpg")
pic2 := Pic.FileNew ("screwdriver.jpg")

%procedure to move the blocker.
procedure Move_Blocker

    cls
    %we wait for the user to press a key.

    %we erase a previously positioned blocker.
    locate (Blocker_Row, Blocker_Column)
    put BLANK_BLOCKER

    % we adjust the position of the blocker
    % according to the direction specified
    % by the user.

    % if Key = RIGHT_ARROW then
    %     Blocker_Column := Blocker_Column + 2
    % elsif Key = LEFT_ARROW then
    %     Blocker_Column := Blocker_Column - 2
    % elsif Key = HOME then
    %     Blocker_Column := 2
    % elsif Key = END then
    %     Blocker_Column := 75
    % end if

    var chars : array char of boolean
    Input.KeyDown (chars)
    if chars (KEY_RIGHT_ARROW) then
	Blocker_Column := Blocker_Column + 2
    elsif chars (KEY_LEFT_ARROW) then
	Blocker_Column := Blocker_Column - 2
    elsif chars (KEY_UP_ARROW) then
	Blocker_Column := 2
    elsif chars (KEY_DOWN_ARROW) then
	Blocker_Column := 75
    end if

    % we do not allow the blocker to be moved
    % beyond the borders of the screen.

    if Blocker_Column > 75 then
	Blocker_Column := 75
    elsif Blocker_Column < 2 then
	Blocker_Column := 2
    end if

    % the blocker is displayed on the screen.

    locate (Blocker_Row, Blocker_Column)
    put BLOCKER

end Move_Blocker
%ends the procedure.

procedure START
    Music.PlayFileLoop ("Doctor Who A Good Man Goes To War Extended Poem.mp3")
    colorback (black) %sets background color.
    cls %clears the screen.
    color (brightblue)
    Pic.Draw (pic2, 300, 25, picCopy)
    put "Hello, seeing that you have just hit a roadblock in your travels, you will need to re-fuel the TARDIS " ..
    put "You will have to collect as much Super Nova Dust as you   can in order to fuel your time machine. " ..
    put "Best of luck! We will give you a manual for your time machine when you are done... " ..
    put "Try not to throw the manual into a   Super Nova when you disagree with it like before. Recall that you must collect  20 pieces of Dust. But remember, your time is running out..."
    put skip
    put "Please select the difficulty that you wish to complete this on:"
    put " "
    put "       Type 1, 2 or 3 to pick"
    put "       1. BABY (if you are aboslutely horrible at keeping your Time Machine)"
    put "       2. INTERMEDIATE (if you still have a few difficulties)"
    put "       3. ADVANCED (if you are The Doctor or River Song)"
    put " "
    loop
	put "Please enter your choice : " ..
	get StartANS %takes input from user.
	if StartANS = "1" or StartANS = "2" or StartANS = "3" then
	    exit %leaves the loop.
	else
	    put StartANS, " is not a valid answer."
	    flag := "continue" %error proofs the program.
	end if
	Music.PlayFileStop
	%sets up levels.
    end loop
    if StartANS = "1" then
	WAIT := 200
    elsif StartANS = "2" then
	WAIT := 100
    elsif StartANS = "3" then
	WAIT := 50
    end if
    cls
    setscreen ("noecho,nocursor,msdos,graphics") %sets the screen accordingly.
end START %ends the procedure START.


%tells turing to activate the procedure START.
START

%tells turing to play music located on that specific directory.
Music.PlayFileLoop ("I am the Doctor.mp3")

locate (Blocker_Row, Blocker_Column)
put BLOCKER     %puts the blocker.

randomize

clock (Start)     %tells it to start the clock.

%counter at the top of the screen.
for Asterisk : 1 .. NUMBER_OF_ASTERISKS
    locate (1, 1)
    put "Asterisk #", Asterisk

    %chooses a random number to set as the asterisk.
    randint (Asterisk_Column, 2, 79)

    loop

	if hasch then
	    Move_Blocker
	end if

	%puts the asterisk.
	locate (Asterisk_Row, Asterisk_Column)
	put "*" ..
	delay (WAIT)

	%erases the asterisk.
	locate (Asterisk_Row, Asterisk_Column)
	put " "


	Asterisk_Row := Asterisk_Row + 1

	if Asterisk_Row > 24 then
	    Asterisk_Row := 2
	end if
	if Asterisk_Column >= Blocker_Column and
		Asterisk_Column <= Blocker_Column + 4 and
		Asterisk_Row = 24 then
	    exit
	elsif Asterisk_Row = 24 and
		(Asterisk_Column < Blocker_Column or
		Asterisk_Column > Blocker_Column + 4) then
	end if
    end loop
end for
Music.PlayFileStop
Music.PlayFileLoop ("Tick Tock Goes The Clock....mp3")
clock (Finish)     %tells it to finish the timer.
cls
%tels it to show the time.
put "TIME: ", (Finish - Start) / 1000, " Seconds."
color (red)
Pic.Draw (pic1, 300, 25, picCopy)     %puts the picture.
locate (11, 10)
put "You have completed your mission... But your time is still running out..."


