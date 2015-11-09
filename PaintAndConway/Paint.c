#include <stdio.h>
#include <stdlib.h>
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

//setting all golbal variables
static int xx = 0;
static int yy = 0;// xx and yy make up the second point
static int x = 0;
static int y = 0;// x and y make up the first point
static bool down = (false);
static int flag = 0;//initiating a flag that controls what shape is being drawn
static int counter = 0;

void CLS(void){//function to clear the screen
	glPointSize(600);
	glColor3f(0.0f, 0.0f, 0.0f);
	glBegin(GL_POINTS);
		glVertex2f(300, 300);
	glEnd();
	glColor3f(1.0f, 1.0f, 1.0f);
	glFlush();
}

void point(int a, int b){//function to draw a point
	glPointSize(3);
	glBegin(GL_POINTS);
		glVertex2f(a, b);
	glEnd();
}

void squarePoints(int x0, int y0, int x1, int y1){//This function draws a square
	int x2 = x1;
	int y2 = y0;
	int x3 = x0;
	int y3 = y1;
	int y = y3;
	if(x1 > x0){//this is for the positive quadrant
		for(int x=x3; x<=x1; x++){
			point(x, y);
		}
		int x = x1;
		for(int y=y1; y<=y2; y++){
			point(x, y);
		}
		y = y2;
		for(int x=x2; x>=x0; x--){
			point(x, y);
		}
		x = x0;
		for(int y=y0; y>=y3; y--){
			point(x, y);
		}
	}
	if(x1 < x0){//this is for the negative quadrant
		for(int x=x3; x>=x1; x--){
			point(x, y);
		}
		int x = x1;
		for(int y=y1; y>=y2; y--){
			point(x, y);
		}
		y = y2;
		for(int x=x2; x<=x0; x++){
			point(x, y);
		}
		x = x0;
		for(int y=y0; y<=y3; y++){
			point(x, y);
		}
	}
	if(y1 > y0){//this is for the other quadrant
		for(int x=x3; x<=x1; x++){
			point(x, y);
		}
		int x = x1;
		for(int y=y1; y>=y2; y--){
			point(x, y);
		}
		y = y2;
		for(int x=x2; x>=x0; x--){
			point(x, y);
		}
		x = x0;
		for(int y=y0; y<=y3; y++){
			point(x, y);
		}
	}
	if(y1 < y0){//and the fourth quadrant
		for(int x=x3; x<=x1; x++){
			point(x, y);
		}
		int x = x1;
		for(int y=y1; y<=y2; y++){
			point(x, y);
		}
		y = y2;
		for(int x=x2; x>=x0; x--){
			point(x, y);
		}
		x = x0;
		for(int y=y0; y>=y3; y--){
			point(x, y);
		}
	}
}

//This function was made with the help of another person's code, located here:
//http://rosettacode.org/wiki/Bitmap/Bresenham's_line_algorithm#C.2B.2B
void linePoints(int x0, int y0, int x1, int y1) {//this function draws lines
	const bool steep = (abs(y1 - y0) > abs(x1 - x0));
	if(steep){
		int temp = x0;
		x0 = y0;
		y0 = temp;
		temp = x1;
		x1 = y1;
		y1 = temp;
	}
	if(x0 > x1){
		int temp = x0;
		x0 = x1;
		x1 = temp;
		temp = y0;
		y0 = y1;
		y1 = temp;
	}
	const float dx = x1 - x0;
	const float dy = abs(y1 - y0);
	float error = dx/2.0;
	const int ystep = (y0 < y1) ? 1 : -1;
	int y = y0;
	const int maxX = x1;
	for(int x=x0; x<maxX; x++){
		if(steep){
			point(y, x);
		}
		else{
			point(x, y);
		}
		error = error - dy;
		if(error < 0){
			y = y + ystep;
			error = error + dx;
		}
	}
}

//This function was coded with the help of another person's code, located here:
//https://en.wikipedia.org/wiki/Midpoint_circle_algorithm
void circlePoints(int x0, int y0, int x1, int y1){//this function draws a circle
	int radius = sqrt(pow((x1 - x0), 2) + pow((y1 - y0), 2));
	int x = radius;
	int y = 0;
	int decisionOver2 = 1 - x;

	while( y <= x ){
		point( x + x0,  y + y0);
		point( y + x0,  x + y0);
		point(-x + x0,  y + y0);
		point(-y + x0,  x + y0);
		point(-x + x0, -y + y0);
		point(-y + x0, -x + y0);
		point( x + x0, -y + y0);
		point( y + x0, -x + y0);
		y++;
    if (decisionOver2<=0){
      decisionOver2 += 2 * y + 1;
    }
    else{
      x--;
      decisionOver2 += 2 * (y - x) + 1;
    }
  }
}

void display(void){//displays different shapes depending on the chosen shape
	if(flag == 1){
		if(down == true){
			point(x, y);
		}
	}
	if(flag == 2 && counter == 2){
		linePoints(x, y, xx, yy);
		counter = 0;
	}
	if(flag == 3 && counter == 2){
		squarePoints(x, y, xx, yy);
		counter = 0;
	}
	if(flag == 4 && counter == 2){
		circlePoints(x, y, xx, yy);
		counter = 0;
	}
	glFlush();
}

void updateMouse(int a, int b){//function used to update the mouse click location
	x = a;
	y = 600 - b;
}

void mouse(int btn, int state, int _x, int _y){
	switch(btn){
		case GLUT_LEFT_BUTTON:
			if(state == (GLUT_DOWN)){
				down = (true);
				if(flag == 2 || flag == 3 || flag == 4){//when the left button is clicked...
					if(counter == 0){//first point is saved...
						counter++;
						x = _x;
						y = 600 - _y;
					}
					else{//then the second point is saved
						counter++;
						xx = _x;
						yy = 600 - _y;
					}
				}
			}
			else{
				down = (false);
			}
			break;
			
		default:
			break;
	}
}

void keyboard(unsigned char key, int x, int y){
	switch(key){
		case 'c'://press c to clear the screen
			CLS();
			break;
			
		case 'q': //press q to quit the program
			exit(0);
			break;
			
		default:
			break;
	}
}

void motion(int x, int y){//updates mouse locations continuously, used for drawing points
	if(flag == 1){
		updateMouse(x, y);
	}
}

void timerRedisplay(int value){//setting screen to 30fps
	glutTimerFunc(32, timerRedisplay, 0);
	display();
}

void menu(int value){ //giving the menu functionality
	srand (time(NULL));
	switch(value){
		case 0:
			glColor3f(1.0f, 0.0f, 0.0f);
			break;
			
		case 1:
			glColor3f(0.0f, 1.0f, 0.0f);
			break;
			
		case 2:
			glColor3f(0.0f, 0.0f, 1.0f);
			break;
			
		case 3:
			glColor3f(1.0f, 0.0f, 1.0f);
			break;
			
		case 4:
			glColor3f(1.0f, 1.0f, 0.0f);
			break;
			
		case 5:
			if(rand() % 5 == 0){
				glColor3f(1.0f, 0.0f, 0.0f);
			}
			if(rand() % 5 == 1){
				glColor3f(0.0f, 1.0f, 0.0f);
			}
			if(rand() % 5 == 2){
				glColor3f(0.0f, 0.0f, 1.0f);
			}
			if(rand() % 5 == 3){
				glColor3f(1.0f, 0.0f, 1.0f);
			}
			if(rand() % 5 == 4){
				glColor3f(1.0f, 1.0f, 0.0f);
			}
			break;
			
		case 6:
			flag = 1;
			break;
			
		case 7:
			flag = 2;
			break;
			
		case 8:
			flag = 3;
			break;
			
		case 9:
			flag = 4;
			break;
		
		case 10:
			exit(0);
			break;
			
		default:
			break;
	}
}

void glutCallbacks(){
	glutDisplayFunc(display);
	glutKeyboardFunc(keyboard);
	glutMouseFunc(mouse);
	glutMotionFunc(motion);
}

void initMenu(){ //creating the menu
	int subid1 = glutCreateMenu(menu);
	glutAddMenuEntry("Red", 0);
	glutAddMenuEntry("Green", 1);
	glutAddMenuEntry("Blue", 2);
	glutAddMenuEntry("Purple", 3);
	glutAddMenuEntry("Yellow", 4);
	glutAddMenuEntry("Random", 5);
	int subid2 = glutCreateMenu(menu);
	glutAddMenuEntry("Point", 6);
	glutAddMenuEntry("Line", 7);
	glutAddMenuEntry("Rectangle", 8);
	glutAddMenuEntry("Circle", 9);
	int menuid = glutCreateMenu(menu);
	glutSetMenu(menuid);
	glutAddSubMenu("Color", subid1);
	glutAddSubMenu("Shapes", subid2);
	glutAddMenuEntry("Quit", 10);
	
	glutAttachMenu(GLUT_RIGHT_BUTTON);
}

int main(int argc, char** argv){
	glutInit(&argc, argv);
	glutInitDisplayMode(GLUT_RGB|GLUT_SINGLE);
	glutInitWindowSize(600, 600);
	glutInitWindowPosition(0, 0);
	glutCreateWindow("Paint");
	glutCallbacks();
	initMenu();
	timerRedisplay(0);
	
	glViewport(0, 0, 600, 600);
	glMatrixMode(GL_PROJECTION);
	glLoadIdentity();
	gluOrtho2D(0.0, 600.0, 0.0, 600.0);
	
	//clears the screen twice to make starting backgrounf color black
	CLS();
	CLS();
	
	printf("Press c to clear screen\n");
	printf("Press q to quit the program\n");
	printf("All other options are in right click menus\n");
	printf("Default color is white");
	
	glutMainLoop();
	return 0;
}