#include "util.h"

unsigned int FileRead(istream & is, vector <char> & buff) {
	is.read(&buff[0], buff.size());
	return is.gcount();
}

unsigned int CountLines(const vector <char> & buff, int sz) {
	int newlines = 0;
	const char * p = &buff[0];
	for (int i = 0; i < sz; i++) {
		if (p[i] == '\n') {
			newlines++;
		}
	}
	return newlines;
}

int fileLineCnt(char* fileName){
	time_t now = time(0);
	ifstream ifs(fileName);
	int n = 0;
	string s;
	while (getline(ifs, s)) {
		n++;
	}
	cout << "system: File size calulation time[s]: " <<time(0) - now << endl;
	return n;
}


void tokenizeLine(char** line)
{
	int i = 0;
	char* s;
	line[i++] = strtok(line[0], " \t\n");
	while (line[i - 1] != NULL)
	{
		line[i++] = strtok(NULL, " \t\n");
	}
}

void resetTokens(char* line, char** tokens)
{
	tokens[0] = line;
	for (int i = 1; i< 10; tokens[i++] = 0);
}


/*__global__ void loading(int** memMatrix, vector<boost::dynamic_bitset<> > bitMatrix, int numOfTransactions, int numOfItemsInLine){
	
	int idx = blockIdx.x*blockDim.x + threadIdx.x;
	int num;
	if (idx < numOfTransactions){
		for (int i = 0; i < numOfItemsInLine; i++){

			if (num = memMatrix[idx][i] == 0) break;
			bitMatrix[num][idx] = 1;
		}
	}
}
*/