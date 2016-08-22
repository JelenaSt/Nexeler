#include "bitmatrix.h"


BitMatrix::BitMatrix(){}
BitMatrix::BitMatrix(int numOfTransactions, float minSupport)
{
	this->numOfTransactions = numOfTransactions;
	this->minSupport = minSupport * numOfTransactions;
	this->numOfEntrys = 100;

	this->matrixTags = vector <int>(numOfEntrys);
	this->matrixSets = vector<boost::dynamic_bitset<> >(numOfEntrys, boost::dynamic_bitset<>(numOfTransactions));
}

BitMatrix::~BitMatrix(){}

int BitMatrix::getnumOfTransactions(){
	return numOfTransactions;
}

int BitMatrix::getnumOfEntrys(){
	return numOfEntrys;
}

void BitMatrix::loadLine(char** tokens, int lineNum, int lineMaxSize){

	for (int i = 0; i < lineMaxSize; i++){
		if (tokens[i] == NULL) break;
		matrixSets[atoi(tokens[i])-1][lineNum] = 1;
	}
}


void BitMatrix::printBitMatrix(){
	cout << "control: BitMatrix:" << endl;
	for (int i = 0; i < numOfEntrys; i++){
		cout << i + 1 << ". " << matrixSets[i] << endl;
	}
}

void BitMatrix::pruneEntries(){
	
	int currSet = 0;
	
	for (int i = 0; i < numOfEntrys; i++){
	
		if (matrixSets[i].count() >= minSupport){
			matrixTags[currSet] = i + 1;
			matrixSets[currSet] = matrixSets[i];
			currSet++;
		}
	}
	
	numOfEntrys = currSet;
	
	matrixSets.resize(currSet);
	matrixTags.resize(currSet);
}


void BitMatrix::printRearangedBitMatrix(){
	
	cout << "control: \n\tBitMatrix: " << endl;
	cout << "\tNumber of entries: " << numOfEntrys << endl;
	cout << "\tNumber of transactions: " << numOfTransactions << endl;
	for (int i = 0; i < numOfEntrys; i++){
		cout << "\t" << matrixTags[i] << ". " << matrixSets[i] << endl;
	}
}

void BitMatrix::quickSort(int left, int right) {
	int i = left, j = right;
	boost::dynamic_bitset<> tmpSet(numOfTransactions);
	int tmpTag;
	int pivot = (left + right) / 2;

	/* partition */
	while (i <= j) {
		while (matrixSets[i].count() > matrixSets[pivot].count())
			i++;
		while (matrixSets[j].count() < matrixSets[pivot].count())
			j--;
		if (i <= j) {
			tmpSet = matrixSets[i];
			tmpTag = matrixTags[i];

			matrixSets[i] = matrixSets[j];
			matrixTags[i] = matrixTags[j];

			matrixSets[j] = tmpSet;
			matrixTags[j] = tmpTag;
		
			i++;
			j--;
		}
	};

	/* recursion */
	if (left < j)
		quickSort(left, j);
	if (i < right)
		quickSort(i, right);
}