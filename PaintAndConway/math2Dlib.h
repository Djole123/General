#ifndef MATH2D_H_INCLUDED
#define MATH2D_H_INCLUDED
#include <math.h>

class point2D{
 public:
  point2D();
  point2D(float inX, float inY);
  float x;
  float y;
};

class vec2D{
 public:
  vec2D();
  vec2D(float inA, float inB);
  float a;
  float b;
  float magnitude();
};

class colour{
	public:
	colour();
	colour(float inR, float inG, float inB);
	float r;
	float g;
	float b;
};
/*
class _2DMathLib {
	public:
	        _2DMathLib();
		static float distance (point2D start, point2D end);
		static float fastDistance (point2D start, point2D end);
};
*/

float distance(point2D start, point2D end){
	return sqrt(pow(end.x - start.x, 2) + pow(end.y - start.y, 2));
}

float fastDistance(point2D start, point2D end){
	return pow(end.x - start.x, 2) + pow(end.y - start.y, 2);
}

float length(vec2D vector){
	return sqrt(pow(vector.a, 2) + pow(vector.b, 2));
}

vec2D norm(vec2D vector){
	return vec2D((vector.a)/(length(vector)), (vector.b)/(length(vector)));
}

vec2D vecMult(vec2D vector, float scalar){
	return vec2D(scalar*vector.a, scalar*vector.b);
}

vec2D createVec (point2D point1, point2D point2){
	return vec2D(point2.x - point1.x, point2.y - point1.y);
}

point2D movePoint (point2D p, vec2D v){
	return point2D(p.x + v.a, p.y + v.b);
}

#endif
