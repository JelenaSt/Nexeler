#ifndef __BITMATRIX__
#define __BITMATRIX__

#include <boost/dynamic_bitset.hpp>
#include <vector>
#include <iostream>
using namespace std;

class BitMatrix
{
public:
	BitMatrix();
	BitMatrix(int, float);
	~BitMatrix();

	int getnumOfTransactions();
	int getnumOfEntrys();
	
	int numOfTransactions;
	int numOfEntrys;
	int minSupport;

	vector<int> matrixTags;
	vector<boost::dynamic_bitset<>> matrixSets;

	//first faze - generating vertical database
	void loadLine(char**, int, int);
	void printBitMatrix(); // print initial matrix before it is reorganized
	void pruneEntries();	//delete nods with support < minSupport
	void printRearangedBitMatrix();
	void quickSort(int left, int right);
};


#endif