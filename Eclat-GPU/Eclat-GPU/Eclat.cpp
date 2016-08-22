#include "eclat.h"

Eclat::Eclat(char* src, char* dst, float minSupport){

	openFiles(src,dst);

	this->minSupport = minSupport;
	this->numOfTransactions = fileLineCnt(src);

	this->bitMatrix = BitMatrix(numOfTransactions, minSupport);
	cout << "info:	BitMap is created. " ;
	cout << "Number of transactions : " << bitMatrix.getnumOfTransactions() << ", number of entries: " << bitMatrix.getnumOfEntrys() << "." << endl;

}

Eclat::	~Eclat(){
	closeFiles();
}

void Eclat::openFiles(char* src, char* dst)
{
	source.open(src, ios::in);
	destination.open(dst, ios::out | ios::binary);

	cout << "info:	Source and destination files are opened." << endl;
}

void Eclat::closeFiles()
{
	source.close();
	destination.close();
	cout << "info:	Source and destination files are closed." << endl;
}

void Eclat::generateVerticalBase(){
	
	char line[200];
	char** tokens = new char*[MAXITEMSINLINE];

	int currLine = 0;

	while (!source.eof()){
	
		source.getline(line, 200);

		resetTokens(line, tokens);
		tokenizeLine(tokens);
		bitMatrix.loadLine(tokens, currLine, MAXITEMSINLINE);

		currLine++;
	}
}

void Eclat::dataPreprocessing(){

	generateVerticalBase();
//	bitMatrix.printBitMatrix();
	bitMatrix.pruneEntries();
//	bitMatrix.printRearangedBitMatrix();
	bitMatrix.quickSort(0, bitMatrix.numOfEntrys - 1);
	bitMatrix.printRearangedBitMatrix();

}

void Eclat::run(){
	time_t now = time(0);
	dataPreprocessing();
	cout << "system: Data preprocessing calulation time[s]: " << time(0) - now << endl;
}