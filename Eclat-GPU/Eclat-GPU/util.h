#include "cuda_runtime.h"
#include "device_launch_parameters.h"
#include <iostream>
#include <fstream>
#include <vector>
#include <ctime>
#include <string>
#include <boost/dynamic_bitset.hpp>
#include <vector>
using namespace std;


int fileLineCnt(char*);
void tokenizeLine(char**);
void resetTokens(char*, char**);

__global__ void loading(int**, vector<boost::dynamic_bitset<> >,int, int);
