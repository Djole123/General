#include "math2Dlib.h"
#include <math.h>

point2D::point2D() {
	x = 0;
	y = 0;
}

point2D::point2D(float inX, float inY) {
	x = inX;
	y = inY;
}

vec2D::vec2D(){
	a = 0;
	b = 0;
}

vec2D::vec2D(float inA, float inB) {
	a = inA;
	b = inB;
}

float vec2D::magnitude(){
  return 0.0; //(use pathagorean's theorem)
}

colour::colour(){
	r = 0;
	g = 0;
	b = 0;
}

colour::colour(float inR, float inG, float inB){
	r = inR;
	g = inG;
	b = inB;
}
/*
_2DMathLib::_2DMathLib(){
  
}

float _2DMathLib::distance(point2D start, point2D end) {
	return sqrt(pow(end.x - start.x, 2) + pow(end.y - start.y, 2));
}

float _2DMathLib::fastDistance(point2D start, point2D end){
	return pow(end.x - start.x, 2) + pow(end.y - start.y, 2);
}
*/