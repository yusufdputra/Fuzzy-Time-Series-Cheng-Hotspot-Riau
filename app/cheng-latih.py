import pandas as pd 
import numpy as np
# import matplotlib.pyplot as plt
import math
from datetime import datetime
import sys, json

# Baca data
nilai_mentah =  json.loads(sys.argv[1])
nilai = pd.Series(nilai_mentah) 

n = len(nilai) #menghitung panjang list nilai
# ==========================================================================
# Hitung Himpunan semesta
# ==========================================================================

minimum = nilai.min()
maximum = nilai.max()

R = maximum-minimum

K = (1+(3.322*math.log10(n)))

I = (R/K)

# ==========================================================================
# hitung interval Fuzzy
# ==========================================================================
# menentukan batas bawah dan batas atas awal
batas_atas = []
batas_bawah = []
nilai_tengah = []
i = 1
bawah = minimum
atas = minimum

while (i<=math.ceil(K)):    
    bawah = atas
   
    batas_bawah.append(bawah)
    
    atas = bawah+I
    batas_atas.append(atas)
    
    tengah = (bawah+atas)/2
    nilai_tengah.append(tengah)
    
    i+=1
 
# mencari nilai frekuensi
frekuensi = []
jumlah = 0
j = 0
for x in batas_atas:
    
    for y in nilai:
        if (batas_bawah[j] <= y <= x):
            jumlah+=1
    frekuensi.append(jumlah)
    jumlah = 0
    j+=1        

rata_rata_freq = sum(frekuensi)/(len(frekuensi))

# interval yang memiliki nilai frekuensi diatas rata2 frekuensi
# harus dibagi menjadi 2 interval dengan lebar interval yang sama. 

# Cari frekuensinya
index = []
selain = []
i = 0
for x in frekuensi:
    if x >= rata_rata_freq:
        index.append(i)
    else:
        selain.append(i)
    i+=1


# ambil data batas atas batas bawah dari index 
    # membuat batas atas baru
new_batas_atas = []


for x in index: 
    atas = nilai_tengah[x]
    new_batas_atas.append(atas)
    new_batas_atas.append(batas_atas[x])
for x in selain:
    new_batas_atas.append(batas_atas[x])

new_batas_atas.sort()



    #membuat batas bawah baru
new_batas_bawah = []
for x in index:
    new_batas_bawah.append(batas_bawah[x])
    bawah = nilai_tengah[x]
    new_batas_bawah.append(bawah)
    
for x in selain:
    new_batas_bawah.append(batas_bawah[x])
    
new_batas_bawah.sort()

# new_batas_atas = []
# new_batas_bawah = []

# for x in index: 
#     atas = nilai_tengah[x]
#     new_batas_atas.insert(x, atas)
#     new_batas_atas.insert(x, batas_atas[x])

# new_batas_atas.sort()

#     # membuat batas bawah baru
# new_batas_bawah.insert(0, minimum)
# i = 0
# while (i <= len(new_batas_atas)-2)  :
#     new_batas_bawah.insert(i, new_batas_atas[i])
#     i+=1
# new_batas_bawah.sort()

# # hapus batas bawah dan batas atas yang diubah ke kondisi-2
# for x in index:
#     del batas_bawah[0]
#     del batas_atas[0]
# # gabungkan batas bawah dan batas atas yang baru dan yang lama   
# semua_batas_bawah = batas_bawah + new_batas_bawah
# semua_batas_bawah.sort()

# semua_batas_atas = batas_atas + new_batas_atas
# semua_batas_atas.sort()

    # mencari nilai tengah baru
new_nilai_tengah = []
i = 0
for x in new_batas_atas:
    new_nilai_tengah.append((new_batas_bawah[i]+new_batas_atas[i])/2)
    i+=1

#============================================================================
#Mendefinisikan Himpunan Fuzzy 
#============================================================================
    
himpunan_fuzzy = []
i = 1
for x in new_batas_bawah: 
    j = 1
    for y in new_batas_bawah:
        if ((i-j) == 0):
            himpunan_fuzzy.append(1)
            
        elif ((i-j) == 1 or(i-j) == -1 ):
            himpunan_fuzzy.append(0.5)
            
        else:
            himpunan_fuzzy.append(0)
            
        j+=1
    i+=1

#============================================================================
# Mendefinisikan Nilai Linguistik Himpunan Fuzzy 
#============================================================================
       
linguistik = [
        'Sangat-sangat turun drastis sekali',
        'Sangat turun drastis sekali',
        'Sangat turun drastis',
        'Turun drastis',
        'Sangat-sangat turun sekali',
        'Sangat turun sekali',
        'Turun sekali',
        'Cukup turun',
        'Turun',
        'Sedikit turun',
        'Tetap',
        'Sedikit naik',
        'Naik',
        'Cukup naik',
        'Naik sekali',
        'Sangat naik sekali',
        'Sangat-sangat naik sekali',
        'Naik drastis',
        'Sangat naik drastis',
        'Sangat naik drastis sekali',
        'Sangat-sangat naik drastis sekali'
        ]
l_sbb = len(new_batas_bawah)
l_ling = len(linguistik)
l_get = 0
if (l_sbb % 2 == 0): # jika panjang baris ganjil
    del linguistik[10] # hapus value tetap
    
l_get = (l_ling-l_sbb)/2
    
l_getNew = round(l_get)

i = 0

get_nilai_linguistik = []
while (i < l_sbb):
    get_nilai_linguistik.append(linguistik[l_getNew])
    l_getNew+=1
    i+=1

#============================================================================
# Fuzzyfikasi dan Relasi Logika Fuzzy
#============================================================================
fuzzifikasi = []

for x in nilai:
    j = 1
    for y in new_batas_atas:
        if (x <= y):
            fuzzifikasi.append("A" + str(j))
            break
        
        j+=1   
    
#menentukan FLR & FLRG
FLR = []
FLRG = []
FLR.insert(0, "-")

i = 0
for x in fuzzifikasi:
    try:
        FLR.insert(i, str(x)+"->"+str(fuzzifikasi[i+1]))
        j = 1
        for y in new_batas_bawah:    
            if (str(fuzzifikasi[i]) == 'A'+str(j)):
                FLRG.insert(i+1, 'G'+str(j))
            j+=1
        i+=1
    except:
        print ("")

FLRG.append("-")
FLRG_list = pd.DataFrame(FLR)
now_FLRG_list = FLRG_list.groupby(by=0).sum()

#============================================================================
#Pembobotan
#============================================================================

# membuat label horizontal
label_h = []
label_v = []
j = 1
for x in new_batas_bawah:
    label_h.append("A"+str(j))
    label_v.append("A"+str(j))
    j+=1

# memberikan bobot 
bobot_awal = []
j_bobot_baris = []

i = 0
for y in label_h:
    j = 0
    j_bobot = 0
    for z in label_v:
        kondisi = str(label_h[i]) + "->" + str(label_v[j])
        bobot = sum (1 for x in FLR if kondisi == x )
            
        #memasukkan bobot kedalam matriks 2D
        bobot_awal.append(bobot)    
        j_bobot += bobot    
        j+=1
    
    #memasukkan jumlah bobot per baris ke dalam matriks
    j_bobot_baris.insert(i, j_bobot)
    i+=1


# split matriks 1D ke 2D berdasarkan banyak label horizontal/vertikal menggunakan numpy

matriks_pembobotan = np.array_split(bobot_awal, len(label_h))

#memindahkan ke matriks pembobotan terstandarisasi
t = []
i = 0
for x in label_h:
    j = 0
    for y in label_v:
        
        try:
            if (matriks_pembobotan[i][j] == 0):
                ts = 0
            else:
                ts = matriks_pembobotan[i][j]/j_bobot_baris[i]
            
                if (math.isnan(ts)):
                    ts = 0
        except:
            ts = 0
        
        t.append(ts)
        j+=1

    i+=1

# Convert ke matriks pembobotan terstandarisasi
matriks_terstandarisasi = np.array_split(t, len(label_h)) 


#============================================================================
# Menghitung Nilai Peramalan
#============================================================================

nilai_peramalan = []
i = 0
for x in label_h:
    j = 0
    F = 0
    for y in label_v:
        
        try:
            f = matriks_terstandarisasi[i][j]*new_nilai_tengah[j]
            F += f
            
        except:
            f = 0
        j+=1
    nilai_peramalan.insert(i, F)
    i+=1


#============================================================================
# Menghitung Nilai peramalan
#============================================================================

prediksi = []
for x in fuzzifikasi:
    j = 0
    for y in nilai_peramalan:
        if (x == label_h[j]):
            prediksi.append(nilai_peramalan[j])
            
        j+=1


#============================================================================
# Menghitung Nilai RMSE
#============================================================================
#
# rmse = []

# i = 0
# for x in nilai:
#     e =  (x-prediksi[i])**2
#     rmse.append(e)
#     i+=1

# # Menghitung RMSE secara keseluruhan
# sum_rmse = np.sum(rmse)

# rmse_final = np.sqrt(sum_rmse/n)

konstanta = {
    'minimum': minimum,
    'maximum': maximum,
    'R': R,
    'K': K,
    'I': I
}

# batas_bawah.insert(0, minimum)
# batas_atas.insert(0, I)

nilai_batas_kelas = {
    'batas_bawah': batas_bawah,
    'batas_atas': batas_atas,
    'nilai_tengah': nilai_tengah,
    'frekuensi': frekuensi
}


new_nilai_batas_kelas = {
    'batas_bawah':new_batas_bawah,
    'batas_atas':new_batas_atas,
    'nilai_tengah': new_nilai_tengah
}


arr = {
    'prediksi' : prediksi,
    'konstanta': konstanta,
    'nilai_batas_kelas': nilai_batas_kelas,
    'new_nilai_batas_kelas' :new_nilai_batas_kelas,
    'fuzzifikasi' : fuzzifikasi,
    'flr': FLR,
    'flrg':FLRG,
    'matriks_pembobot': bobot_awal,
    'matriks_terstandarisasi': t,
    'defuzzifikasi': nilai_peramalan,
    'himpunan_fuzzy' :himpunan_fuzzy,
    'nilai_linguistik': get_nilai_linguistik
}




xx = json.dumps(arr)



print (xx)





