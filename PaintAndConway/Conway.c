#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <time.h>
#include "Math2Dlib.c"
#include "math2Dlib.h"

#ifdef __APPLE__
#  include <OpenGL/gl.h>
#  include <OpenGL/glu.h>
#  include <GLUT/glut.h>
#else
#  include <GL/gl.h>
#  include <GL/glu.h>
#  include <GL/freeglut.h>
#endif

int speed = 0; //setting speed variable
int pause = 0; //setting pause variable
int counter = 0; //setting counter variable
int count = 1; //setting count variable
int life [250][250]; //creating array where point location will be stored

void point(int x, int y){//Draws a point at a given location
	glBegin(GL_POINTS);
		glVertex2f(x, y);
	glEnd();
	glFlush();
}

void makeGrid(void){//creates the initial grid with randomized starting points
	srand (time(NULL));
	for(int i = 5; i < 246; i = i + 10){
		for(int j = 5; j < 246; j = j + 10){
			glPointSize(9);
			if(rand() % 5 == 0){
				life [i][j] = 0;
			}
			else if(rand() % 5 == 1){
				life [i][j] = 1;
			}
			else{
				life [i][j] = 0;
			}
			glColor3f(0.0, 0.0, 0.0);//sets default color to black
			point(i, j);
		}
	}
}

void liveOrDie(int i, int j){//decides wether a pixel should live or die
	if(counter < 2 && life [i][j] == 1){//if a cell has less than 2 neighbours and the cell is alive it dies
		life [i][j] = 0;
	}
	else if(counter > 3 && life [i][j] == 1){//if there are more than 3 neighbours and the cell is alive it dies
		life [i][j] = 0;
	}
	else if((counter == 2 || counter == 3) && life [i][j] == 1){//if a cell has 2-3 neighbours and is alive, it stays alive
		life [i][j] = 1;
	}
	else if(counter == 3 && life [i][j] == 0){//if a cell has exactly 3 neighbours and is dead, it comes back to life
		life [i][j] = 1;
	}
	counter = 0;//resets neighbour count
}

void scan(void){//scans through the current board and for each cell it counts its neighbours
	for(int i = 5; i < 246; i = i + 10){	
		for(int j = 5; j < 246; j = j + 10){
			if(life [i][j+10] == 1){
				counter++;
			}
			if(life [i+10][j+10] == 1){
				counter++;
			}
			if(life [i+10][j] == 1){
				counter++;
			}
			if(life [i+10][j-10] == 1){
				counter++;
			}
			if(life [i][j-10] == 1){
				counter++;
			}
			if(life [i-10][j-10] == 1){
				counter++;
			}
			if(life [i-10][j] == 1){
				counter++;
			}
			if(life [i-10][j+10] == 1){
				counter++;
			}
			liveOrDie(i, j);
		}
	}
}
	
void display(void){//displays the grid with the cells, black for dead, white for alive
	if(count == 1){
		for(int i = 5; i < 246; i = i + 10){
			for(int j = 5; j < 246; j = j + 10){
				if(life [i][j] == 0){
					glColor3f(0.0f, 0.0f, 0.0f);
					point(i, j);
				}
				else{
					glColor3f(1.0f, 1.0f, 1.0f);
					point(i, j);
				}
			}	
		}
		if(speed == 0){//changes speed on request
			Sleep(1000);
		}
		else{
			Sleep(250);			
		}
		scan();
	}	
}

void keyboard(unsigned char key, int x, int y){
	switch(key){
		case 'q'://press q to exit
			exit(0);
			break;
		
		case 'c'://press c to clear screen
			for(int i = 5; i < 246; i = i + 10){
				for(int j = 5; j < 246; j = j + 10){
					life [i][j] = 0;
				}
			}
			break;
			
		case 'p'://press p to toggle pause
			if(pause == 0){
				count = 0;
				pause++;
			}
			else if(pause == 1){
				count = 1;
				pause = 0;
			}
			break;
			
		case 's'://press s to toggle speed
			if(speed == 0){
				speed++;
			}
			else{
				speed = 0;
			}
			break;
		
		case 'r'://press r to randomize grid
			makeGrid();
		
		default:
			break;
	}
}

void mouse(int btn, int state, int x, int y){
	int i;
	int j;
	int yy = 250 - y;
	switch(btn){
		case GLUT_LEFT_BUTTON: //if the left button is pressed...
			if(x % 5 == 1){//it rounds the click to the closest pixel...
				i = x - 1;
			}
			else if(x % 5 == 2){
				i = x - 2;
			}
			else if(x % 5 == 3){
				i = x + 2;
			}
			else if(x % 5 == 4){
				i = x + 1;
			}
			else{
				i = x;
			}
			if(yy % 5 == 1){
				j = yy - 1;
			}
			else if(yy % 5 == 2){
				j = yy - 2;
			}
			else if(yy % 5 == 3){
				j = yy + 2;
			}
			else if(yy % 5 == 4){
				j = yy + 1;
			}
			else{
				j = yy;
			}
			if(life [i][j] == 0){//then makes that pixel alive if its dead or vice versa
				life [i][j] = 1;
			}
			else{
				life [i][j] = 0;
			}
			break;
			
		default:
			break;
	}
}

void timerRedisplay(int value){//setting screen to 30fps
	glutTimerFunc(32, timerRedisplay, 0);
	display();
}

void glutCallbacks(){
	glutDisplayFunc(display);
	glutKeyboardFunc(keyboard);
	glutMouseFunc(mouse);
}

int main(int argc, char** argv){
	glutInit(&argc, argv);
	glutInitDisplayMode(GLUT_RGB|GLUT_SINGLE);
	glutInitWindowSize(250, 250);
	glutInitWindowPosition(0, 0);
	glutCreateWindow("Game of Life");
	glutCallbacks();
	timerRedisplay(0);
	
	makeGrid();//makes the grid
	
	glViewport(0, 0, 250, 250);
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	gluOrtho2D(0.0, 250.0, 0.0, 250.0);
	
	//prints out instructions for key presses
	printf("Press c to clear screen\n");
	printf("Press q to quit\n");
	printf("Press p once to pause, and again to play\n");
	printf("Press s to toggle speeds, default is slow\n");
	printf("Press r to randomize the grid\n");
	printf("Left click anywhere to edit (clicking takes time to register)\n");
	
	glutMainLoop();
	return 0;
}