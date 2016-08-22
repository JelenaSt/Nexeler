
#include "cuda_runtime.h"
#include "device_launch_parameters.h"

#include <stdio.h>

#define SIZE 1024

// __global__ - kljucna rec - kompajler zna da ce se ova funkcija izvrsavati na gpu
//ova fija ce se izvrsavati u paraleli od strane borjnih threadova

__global__ void vectorAdd(int *a, int *b, int *c, int n){
	
	int i = threadIdx.x;	//jedna nit sabira jedan par
	if (i < n)
		c[i] = a[i] + b[i];
}

int main(){
	/*
	size_t free, total;

	printf("\n");

	cudaMemGetInfo(&free, &total);

	printf("%d KB free of total %d KB\n", free / 1024, total / 1024);
	*/
	/*
	//operisemo sa dva razlicita adresna prostora, jedan je u oviru CPU a drugi u okviru GPU
	//prvo moramo da alociramo prostor na GPU
	//zatim da iskopiramo podatke sa CPU memorije na GPU memoriju (elemente niza a i b)
	//izvrsicemo izracunavanje na GPU (a+b)
	//i nakon toga cemo iskopirati rezultat sa GPU memorje na CPU memoriju (niz c)

	int *a, *b, *c;
	int *d_a, *d_b, *d_c; //d-device
	//imamo razlicite pokazivace za razlicite delove memorije

	a = (int*)malloc(SIZE*sizeof(int));
	b = (int*)malloc(SIZE*sizeof(int));
	c = (int*)malloc(SIZE*sizeof(int));

	cudaMalloc(&d_a, SIZE*sizeof(int));	//alokacije memorije na GPU
	cudaMalloc(&d_b, SIZE*sizeof(int));
	cudaMalloc(&d_c, SIZE*sizeof(int));

	for (int i = 0; i < SIZE; i++){
		a[i] = i;
		b[i] = i;
		c[i] = 0;
	}
	//inicijalizovani podaci
	//nakon alkoacije prostora na GPU kopiramo podatke koje smo upravo inicijalizovali

	cudaMemcpy(d_a, a, SIZE*sizeof(int), cudaMemcpyHostToDevice);
	cudaMemcpy(d_b, b, SIZE*sizeof(int), cudaMemcpyHostToDevice);
	cudaMemcpy(d_c, c, SIZE*sizeof(int), cudaMemcpyHostToDevice);
	
	
	vectorAdd<<<1, SIZE>>>(d_a,d_b,d_c,SIZE);
	//prvi parametar - broj blokova
	//drugi parametar - broj niti u tom bloku


	//copiramo rezultat sa GPU kartice u CPU adresni prosor

	cudaMemcpy(c, d_c, SIZE*sizeof(int), cudaMemcpyDeviceToHost);
	for (int i = 0; i < 10; i++)
		printf("c[%d] = %d \n", i, c[i]);

	free(a);
	free(b);
	free(c);

	//oslobadjamo prostor na GPU
	cudaFree(d_a);
	cudaFree(d_b);
	cudaFree(d_c);
	*/
	return 0; 
}