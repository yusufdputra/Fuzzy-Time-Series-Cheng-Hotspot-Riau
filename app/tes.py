import json, pandas as pd, sys
nilai_mentah =  json.loads(sys.argv[1])
# nilai_batas_atas =  json.loads(sys.argv[2])
# nilai_peramalan =  json.loads(sys.argv[3])

#data = pd.Series(nilai_mentah) 

arr = {
    'a':nilai_mentah
}
xx = json.dumps(arr)
print (xx)