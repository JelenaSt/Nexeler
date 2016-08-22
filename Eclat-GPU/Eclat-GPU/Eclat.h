#ifndef __ECLAT__
#define __ECLAT__

#include <iostream>
#include <fstream>
#include "util.h"
#include "bitmatrix.h"
using namespace std;

#define MAXITEMSINLINE 40

class Eclat{
public:

	fstream source, destination;
	int numOfTransactions;
	float minSupport;

	BitMatrix bitMatrix;


	Eclat(char*, char*, float);
	~Eclat();

	void run();

	void openFiles(char*, char*);
	void closeFiles();

	void generateVerticalBase();
	void dataPreprocessing();

};


#endif