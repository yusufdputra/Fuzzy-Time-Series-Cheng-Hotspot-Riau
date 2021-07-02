import mysql.connector
import pandas as pd
import numpy as np
import math
from datetime import date
import requests
import csv
import sys
import json
from datetime import date

# koneksi ke db
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="db_hotspot_riau_v2"
)

# ambil kabupaten
kab_select =  (sys.argv[1])

# ambil data dari db
mycursor = mydb.cursor()
mycursor.execute("SELECT * FROM datasets where kabupaten LIKE '"+kab_select+"'")
myresult = mycursor.fetchall()

# pindah ke array
wak_14_19 = []
kab_14_19 = []
for row in myresult:
    wak_14_19.append(row[1])
    kab_14_19.append(row[2])

# Convert ke format waktu Y-m-d
def Date_Converter(Date):
    return date.strftime(Date,"%Y-%m-%d")
new_wak_14_19 = [Date_Converter(d) for d in wak_14_19]

# ambil data 2020 dari web link
# csv_url = "http://103.51.131.166/getCSV?$$hashKey=object:26&class=hotspot&conf_lvl=low&enddate=2021-1-1T17:00:00.000Z&id=0&loc=%7B%22kec%22:null,%22kab%22:null,%22prov%22:%22Riau%22,%22disp%22:%22Riau%22%7D&mode=cluster&name=Hotspot&startdate=2019-12-31T17:00:00.000Z&time=usedate&visibility=true"

#sampai today
today = str(date.today())
csv_url = 'http://103.51.131.166/getCSV?$$hashKey=object:26&class=hotspot&conf_lvl=low&enddate={today}T17:00:00.000Z&id=0&loc=%7B%22kec%22:null,%22kab%22:null,%22prov%22:%22Riau%22,%22disp%22:%22Riau%22%7D&mode=cluster&name=Hotspot&startdate=2019-12-31T17:00:00.000Z&time=usedate&visibility=true'

# pindah ke array
kab_20 = []
wak_20 = []

with requests.Session() as s:
    download = s.get(csv_url)
    decoded_content = download.content.decode('utf-8')
    cr = csv.reader(decoded_content.splitlines(), delimiter=',')
    my_list = list(cr)
    del my_list[0]
    for row in my_list:
        kab_20.append(row[9])
        wak_20.append(row[1])


# #conv to DataFrame
        
data = pd.DataFrame(
        {'tanggal' : new_wak_14_19 +  wak_20,
         'kabupaten' :kab_14_19+ kab_20
         })
    
# sorted berdasarkan tanggal
data = data.sort_values(by = ['tanggal'])

# pilih berdasarkan kabupaten
kab_ = data.loc[data['kabupaten'] == kab_select]

# hitung banyak kejadian hotspot
kelompok = kab_.groupby('tanggal').count()

# ambil 1 variabel banyak kejadian hotspot kabupaten saja 
n_per_time = kelompok['kabupaten'].tolist() 

# normalisasi
nilai = (n_per_time - np.min(n_per_time))/(np.max(n_per_time)-np.min(n_per_time)) * (2-1)+1

n = len(nilai) #menghitung panjang list nilai

# ==========================================================================
# Hitung Himpunan semesta
# ==========================================================================

minimum = (nilai.min())
maximum = (nilai.max())

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

#mencari nilai frekuensi
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
#    21 nilai linguistik 
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
#Fuzzyfikasi dan Relasi Logika Fuzzy
#============================================================================
fuzzifikasi = []

for x in nilai:
    j = 1
    for y in new_batas_atas:
        if (x <= y):
            fuzzifikasi.append("A" + str(j))
            break;
        
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
            
        #memasukkan bobot kedalam matriks 1D
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
# Menghitung Nilai PREDIKSI
#============================================================================

prediksi = []
for x in fuzzifikasi:
    j = 0
    for y in nilai_peramalan:
        if (x == label_h[j]):
            prediksi.append(nilai_peramalan[j])
            
        j+=1

prediksi_next = (((prediksi[-1]-1) * (np.max(n_per_time)-np.min(n_per_time)))/(2-1))+np.min(n_per_time)
#============================================================================
# Menghitung Nilai MAPE
#============================================================================

mape = []

i = 0
for x in nilai:
    if (x != 0):
        e = abs((x-prediksi[i])/x)
        mape.append(e)
    else:
        mape.append(0)
    i+=1

# Menghitung MAPE
avg_mape = (np.mean(mape))*100

#============================================================================
# LINGUISTIK PREDIKSI
#============================================================================

get_fuzzy = fuzzifikasi[-1]
fuzzy_prediksi_next = ''
n = 1;
for nilai in get_nilai_linguistik:
    if (get_fuzzy == 'A'+str(n)):
        fuzzy_prediksi_next = nilai
        break;
    else:
        continue;
    n+=1


arr = {
    'time' : kelompok.index.tolist(),
    'n_per_time' : n_per_time,
    'prediksi_next' : prediksi_next,
    'avg_mape' : avg_mape,
    'fuzzy_prediksi_next' : fuzzy_prediksi_next
}

xx = json.dumps(arr)

print (xx)















# #for x in kelompok.index:
# #    print(x)

# #nilai = kelompok['Kabupaten']
# #stat, p, lags, obs, crit, t = adfuller(nilai)
# #stat, p
# #
# #print(stat, p)
