import pandas as pd 
import numpy as np
# import matplotlib.pyplot as plt
import math
from datetime import datetime
import sys, json

# Baca data
nilai_mentah =  json.loads(sys.argv[1])
batas_atas =  json.loads(sys.argv[2])
nilai_peramalan =  json.loads(sys.argv[3])


#============================================================================
# Fuzzyfikasi
#============================================================================
fuzzifikasi = []

for x in nilai_mentah:
    j = 1
    for y in batas_atas[0]:
        if (x <= y):
            fuzzifikasi.append("A" + str(j))
            break
        
        j+=1   


# #============================================================================
# # Menghitung Nilai PREDIKSI
# #============================================================================

# membuat label horizontal
label_h = []
j = 1
for x in batas_atas[0]:
    label_h.append("A"+str(j))
    j+=1

prediksi = []

for x in fuzzifikasi:
    j = 0
    for y in nilai_peramalan[0]:
        if (x == label_h[j]):
            prediksi.append(nilai_peramalan[0][j])

        j+=1


#============================================================================
# Menghitung Nilai MAPE
#============================================================================
#
mape = []

i = 0
for x in prediksi:
    if (x != 0):
        e = abs((nilai_mentah[i]-prediksi[i])/nilai_mentah[i])
        mape.append(e)
    else:
        mape.append(0)
    i+=1

# Menghitung MAPE
avg_mape = (np.mean(mape))*100

# print (avg_mape)
# rmse = []

# i = 0
# for x in nilai_mentah:
#     e =  (x-prediksi[i])**2
#     rmse.append(e)
#     i+=1

# # Menghitung RMSE secara keseluruhan
# sum_rmse = np.sum(rmse)

# rmse_final = np.sqrt(sum_rmse/len(nilai_mentah))


arr = {
    'prediksi' : prediksi,
    'fuzzifikasi': fuzzifikasi,
    'mape':avg_mape,
}
xx = json.dumps(arr)
print (xx)





