# Early Warning System for Flooding in Ciliwung River

import json
import time

def Katulampa(tinggi):
    if tinggi > 200:
        statusKatulampa = 'Bahaya'
    elif tinggi > 150:
        statusKatulampa = 'Siaga'
    elif tinggi >= 80:
        statusKatulampa = 'Waspada'
    else:
        statusKatulampa = 'Normal'
    return statusKatulampa

def FlushingAncol(tinggi):
    if tinggi > 220:
        statusFlushingAncol = 'Bahaya'
    elif tinggi > 190:
        statusFlushingAncol = 'Siaga'
    elif tinggi >= 180:
        statusFlushingAncol = 'Waspada'
    else:
        statusFlushingAncol = 'Normal'
    return statusFlushingAncol

def Manggarai(tinggi):
    if tinggi > 960:
        statusManggarai = 'Bahaya'
    elif tinggi > 860:
        statusManggarai = 'Siaga'
    elif tinggi >= 750:
        statusManggarai = 'Waspada'
    else:
        statusManggarai = 'Normal'
    return statusManggarai

def Istiqlal(tinggi):
    if tinggi > 350:
        statusIstiqlal = 'Bahaya'
    elif tinggi > 300:
        statusIstiqlal = 'Siaga'
    elif tinggi >= 250:
        statusIstiqlal = 'Waspada'
    else:
        statusIstiqlal = 'Normal'
    return statusIstiqlal

def JembatanMerah(tinggi):
    if tinggi > 200:
        statusMerah = 'Bahaya'
    elif tinggi > 150:
        statusMerah = 'Siaga'
    elif tinggi >= 140:
        statusMerah = 'Waspada'
    else:
        statusMerah = 'Normal'
    return statusMerah

def prediksiKetinggian(sebelum,sekarang):
    if sekarang > sebelum:
        return sekarang + (sekarang - sebelum)
    elif sebelum > sekarang:
        return sekarang + (sebelum - sekarang)
    else:
        return sebelum

def pintuAirkl(katulampa):
    kl = katulampa
    if (kl == 'Normal'):
        kondisi = 'Dibuka 20%'
    elif(kl == 'Waspada'):
        kondisi = 'Dibuka 40%'
    elif(kl == 'Siaga'):
        kondisi = 'Dibuka 70%'
    elif(kl == 'Bahaya'):
        kondisi = 'Dibuka 100%'
    return kondisi 

def pintuAirfa(flushingAncol):
    fa = flushingAncol
    if (fa == 'Normal') :
        kondisi = 'Dibuka 20%'
    elif(fa == 'Waspada'):
        kondisi = 'Dibuka 40%'
    elif(fa == 'Siaga'):
        kondisi = 'Dibuka 70%'
    elif(fa == 'Bahaya'):
        kondisi = 'Dibuka 100%'
    return kondisi

def pintuAirmg(manggarai):
    mg = manggarai 
    if (mg == 'Normal'):
        kondisi = 'Dibuka 40%'
    elif(mg == 'Waspada'):
        kondisi = 'Dibuka 80%'
    elif(mg == 'Siaga'):
        kondisi = 'Dibuka 90%'
    elif(mg == 'Bahaya'):
        kondisi = 'Dibuka 100%'
    return kondisi

def pintuAirit(istiqlal):
    it = istiqlal
    if (it == 'Normal') :
        kondisi = 'Dibuka 20%'
    elif(it == 'Waspada'):
        kondisi = 'Dibuka 40%'
    elif(it == 'Siaga'):
        kondisi = 'Dibuka 70%'
    elif(it == 'Bahaya'):
        kondisi = 'Dibuka 100%'
    return kondisi

def pintuAirjm(jembatanMerah):
    jm = jembatanMerah
    if (jm == 'Normal'):
        kondisi = 'Dibuka 20%'
    elif(jm == 'Waspada'):
        kondisi = 'Dibuka 40%'
    elif(jm == 'Siaga'):
        kondisi = 'Dibuka 70%'
    elif(jm == 'Bahaya'):
        kondisi = 'Dibuka 100%'
    return kondisi

def prediksiBanjir(Katulampa, flushingAncol, manggarai, istiqlal, jembatanMerah):
    kl = Katulampa
    fa = flushingAncol
    mg = manggarai
    it = istiqlal
    jm = jembatanMerah
    
    # Jika status ketinggian Katulampa berada pada posisi "Siaga" atau "Bahaya" 
    # Maka dapat dipastikan DAS Ciliwung akan banjir
    if kl == 'Siaga' or kl == 'Bahaya':
        pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
    elif kl == 'Waspada':
        # Jika status ketinggian Katulampa berada pada posisi "Waspada"
        # Maka akan dilanjutkan pengecekan kondisi 4 lokasi pemantauan lainnya
        
        # Jika keempatnya "Bahaya"
        if fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Siaga"
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Waspada"
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Normal"
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 2 "Bahaya" 2 "Siaga"
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        
        # Jika 2 "Bahaya" 1 "Siaga" 1 "Waspada"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'

        # Jika 2 "Bahaya" 1 "Siaga" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

        # Jika 2 "Bahaya" 2 "Waspada"
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

        # Jika 2 "Bahaya" 1 "Waspada" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        
        # Jika 1 "Bahaya" 3 "Siaga"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 1 "Bahaya" 2 "Siaga" 1 "Waspada"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 1 "Bahaya" 2 "Siaga" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        

        # Jika 1 "Bahaya" 1 "Siaga" 2 "Waspada"
        #Bahaya,Siaga,Waspada,Waspada
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        #Siaga,Bahaya,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        #Waspada,Bahaya,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        #Bahaya,Waspada,Siaga,Waspada
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        #Siaga,Waspada,Bahaya,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!!'
        #Waspada,Siaga,Bahaya,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Waspada,Siaga,Waspada,Bahaya
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Waspada,Waspada,Bahaya
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Waspada,Siaga,Bahaya
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Bahaya,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Bahaya,Waspada,Waspada,Siaga
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Waspada,Bahaya,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        
        # Jika 1 "Bahaya" 1 "Siaga" 1 "Waspada" 1 "Normal"
        # Normal,Siaga,Waspada,Bahaya
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Waspada,Bahaya
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Normal,Siaga,Bahaya
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada Lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Normal,Waspada,Siaga,Bahaya
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Siaga,Waspada,Normal,Bahaya
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Siaga,Normal,Bahaya
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Siaga,Bahaya,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Siaga,Waspada,Bahaya,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi istiqlal berpotensi terjadi banjir!'
        # Bahaya,Waspada,Siaga,Normal
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Waspada,Bahaya,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Menggarai berpotensi terjadi banjir!'
        # Siaga,Bahaya,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Siaga,Waspada,Normal
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Normal,Waspada,Siaga
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Normal,Bahaya,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Waspada,Bahaya,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Waspada,Normal,Siaga
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Normal,Waspada,Bahaya,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Waspada,Normal,Bahaya,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Siaga,Normal,Bahaya,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Normal,Siaga,Bahaya,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Bahaya,Siaga,Normal,Waspada
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Siaga,Bahaya,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Normal,Bahaya,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Normal,Siaga,Waspada
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'

        # Jika 1 "Bahaya" 1 "Siaga" 2 "Normal"
        # Normal,Normal,Siaga,Bahaya
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Normal,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Normal,Bahaya,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Siaga,Bahaya,Normal
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Siaga,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Normal,Siaga,Normal,Bahaya
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Bahaya,Siaga,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Normal,Normal,Bahaya
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Bahaya,Normal
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Bahaya,Normal,Normal,Siaga
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Normal,Siaga,Normal
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Siaga,Normal,Normal
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Siaga,Bahaya,Normal,Normal
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        
        # Jika 1 "Bahaya" 1 "Waspada" 2 "Normal"
        
        # Normal,Normal,Waspada,Bahaya
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Normal,Bahaya,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Waspada,Normal,Bahaya
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Normal,Waspada
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Normal,Waspada,Bahaya,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Bahaya,Waspada,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Waspada,Normal,Normal,Bahaya
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Normal,Bahaya,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Bahaya,Normal,Normal,Waspada
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Normal,Waspada,Normal
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Waspada,Normal,Normal
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Bahaya,Normal,Normal
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        
        # Jika 1 "Bahaya" 3 "Waspada"
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

        # Jika 1 "Bahaya" 3 "Normal"
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        
        # 4 Siaga
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        # 3 Siaga 1 Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        # 3 Siaga 1 Normal
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
            
        # 2 Siaga 2 Waspada
        
        # Siaga,Siaga,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Waspada,Siaga,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Siaga,Waspada,Waspada,Siaga
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan istiqlal berpotensi banjir!'
        # Waspada,Siaga,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        # Waspada,Waspada,Siaga,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'   


        # 2 Siaga 1 Waspada 1 Normal
        
        # Normal,Siaga,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        # Normal,Siaga,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        # Normal,Waspada,Siaga,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Siaga,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Siaga,Normal,Waspada,Siaga
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        # Siaga,Siaga,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Siaga,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Waspada,Normal,Siaga
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah  berpotensi banjir!'
        # Siaga,Waspada,Siaga,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Waspada,Normal,Siaga,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'

        # 2 Siaga 2 Normal
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Waspada,Waspada,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
        # Waspada,Normal,Waspada,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
        # Normal,Waspada,Normal,Waspada
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
        # Waspada,Normal,Normal,Waspada
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Normal,Waspada,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'
            
        # 1 Siaga 3 Waspada
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # 1 Siaga 3 Normal
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # 2 Waspada 2 Normal
        
        # Waspada,Waspada,Normal,Normal
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Waspada,Waspada,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
        # Waspada,Normal,Waspada,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
        # Normal,Waspada,Normal,Waspada
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
        # Waspada,Normal,Normal,Waspada
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Normal,Waspada,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'
            
            
        # 2 Waspada 1 Siaga 1 Normal
        
        # Waspada,Waspada,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal warga perlu waspada!'
        # Siaga,Waspada,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
        # Waspada,Siaga,Waspada,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
        # Siaga,Waspada,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
        # Waspada,Siaga,Normal,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
        # Normal,Siaga,Waspada,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai warga perlu waspada!'
        # Siaga,Normal,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Normal,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Waspada,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
        # Waspada,Waspada,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Waspada,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Normal,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'  

        # 1 Waspada 3 Normal
        
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Jembatan Merah warga perlu waspada!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Istiqlal warga perlu waspada!'
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Manggarai warga perlu waspada!'
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol warga perlu waspada!'
        
        # 2 Normal 1 Siaga 1 Waspada
        
        # Normal,Normal,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == '' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Normal,Siaga,Normal,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Normal,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
        # Normal,Siaga,Waspada,Normal
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Waspada,Siaga,Normal,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Waspada,Normal,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Normal,Waspada,Siaga,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!' 
        # Waspada,Normal,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!' 
        # Normal,Normal,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!' 
        # Waspada,Normal,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!' 
        # Normal,Waspada,Normal,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!' 
            
        else:
            pesan = '[AMAN] Pada lokasi Katulampa warga perlu waspada!'
    else:
        # Jika keempatnya "Bahaya"
        if fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Siaga"
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Waspada"
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 3 "Bahaya" 1 "Normal"
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 2 "Bahaya" 2 "Siaga"
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        
        # Jika 2 "Bahaya" 1 "Siaga" 1 "Waspada"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Flushing Ancol dan Manggarai berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Flushing Ancol dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Flushing Ancol dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Manggarai dan Istiqlal berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Manggarai dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Istiqlal dan Jembatan Merah berpotensi terjadi banjir!'

        # Jika 2 "Bahaya" 1 "Siaga" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'

        # Jika 2 "Bahaya" 2 "Waspada"
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'

        # Jika 2 "Bahaya" 1 "Waspada" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        
        # Jika 1 "Bahaya" 3 "Siaga"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 1 "Bahaya" 2 "Siaga" 1 "Waspada"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        
        # Jika 1 "Bahaya" 2 "Siaga" 1 "Normal"
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        

        # Jika 1 "Bahaya" 1 "Siaga" 2 "Waspada"
        #Bahaya,Siaga,Waspada,Waspada
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        #Siaga,Bahaya,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        #Waspada,Bahaya,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        #Bahaya,Waspada,Siaga,Waspada
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        #Siaga,Waspada,Bahaya,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!!'
        #Waspada,Siaga,Bahaya,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Waspada,Siaga,Waspada,Bahaya
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Waspada,Waspada,Bahaya
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Waspada,Siaga,Bahaya
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Bahaya,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Bahaya,Waspada,Waspada,Siaga
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Waspada,Bahaya,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        
        # Jika 1 "Bahaya" 1 "Siaga" 1 "Waspada" 1 "Normal" (UDAH BENER)
        # Normal,Siaga,Waspada,Bahaya
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Waspada,Bahaya
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Normal,Siaga,Bahaya
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada Lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Normal,Waspada,Siaga,Bahaya
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Siaga,Waspada,Normal,Bahaya
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Siaga,Normal,Bahaya
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi terjadi banjir!'
        # Waspada,Siaga,Bahaya,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Siaga,Waspada,Bahaya,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi istiqlal berpotensi terjadi banjir!'
        # Bahaya,Waspada,Siaga,Normal
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Waspada,Bahaya,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Menggarai berpotensi terjadi banjir!'
        # Siaga,Bahaya,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Siaga,Waspada,Normal
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Normal,Waspada,Siaga
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Normal,Bahaya,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Waspada,Bahaya,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Waspada,Normal,Siaga
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Normal,Waspada,Bahaya,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Waspada,Normal,Bahaya,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Siaga,Normal,Bahaya,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Normal,Siaga,Bahaya,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi terjadi banjir!'
        # Bahaya,Siaga,Normal,Waspada
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'
        # Siaga,Bahaya,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Normal,Bahaya,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi terjadi banjir!'
        # Bahaya,Normal,Siaga,Waspada
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi terjadi banjir!'

        # Jika 1 "Bahaya" 1 "Siaga" 2 "Normal"
        # Normal,Normal,Siaga,Bahaya
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Normal,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Normal,Bahaya,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Siaga,Bahaya,Normal
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Siaga,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Normal,Siaga,Normal,Bahaya
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Bahaya,Siaga,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Normal,Normal,Bahaya
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Bahaya,Normal
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Bahaya,Normal,Normal,Siaga
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Normal,Siaga,Normal
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Siaga,Normal,Normal
        elif fa == 'Bahaya' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Siaga,Bahaya,Normal,Normal
        elif fa == 'Siaga' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        
        # Jika 1 "Bahaya" 1 "Waspada" 2 "Normal"
        
        # Normal,Normal,Waspada,Bahaya
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Normal,Bahaya,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Waspada,Normal,Bahaya
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Bahaya,Normal,Waspada
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Normal,Waspada,Bahaya,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Bahaya,Waspada,Normal
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        # Waspada,Normal,Normal,Bahaya
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Normal,Bahaya,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        # Bahaya,Normal,Normal,Waspada
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Normal,Waspada,Normal
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Bahaya,Waspada,Normal,Normal
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Bahaya,Normal,Normal
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        
        # Jika 1 "Bahaya" 3 "Waspada"
        elif fa == 'Bahaya' and mg == 'Waspada' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Bahaya' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Bahaya' and jm == 'Waspada':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Waspada' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'

        # Jika 1 "Bahaya" 3 "Normal"
        elif fa == 'Bahaya' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Flushing Ancol berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Bahaya' and it == 'Normal' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Bahaya' and jm == 'Normal':
            pesan = '[EVAKUASI] Pada lokasi Istiqlal berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Bahaya':
            pesan = '[EVAKUASI] Pada lokasi Jembatan Merah berpotensi banjir!'
        
        # 4 Siaga
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        # 3 Siaga 1 Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        # 3 Siaga 1 Normal
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[EVAKUASI] DAS Ciliwung berpotensi terjadi banjir!'
        


        # 2 Siaga 1 Waspada 1 Normal
        
        # Normal,Siaga,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        # Normal,Siaga,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'
        # Normal,Waspada,Siaga,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Siaga,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Siaga,Normal,Waspada,Siaga
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        # Siaga,Siaga,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Siaga,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Waspada,Normal,Siaga
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah  berpotensi banjir!'
        # Siaga,Waspada,Siaga,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Waspada,Normal,Siaga,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai dan Istiqlal berpotensi banjir!'

        # 2 Siaga 2 Waspada
        
        # Siaga,Siaga,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Manggarai berpotensi banjir!'
        # Siaga,Waspada,Siaga,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Istiqlal berpotensi banjir!'
        # Siaga,Waspada,Waspada,Siaga
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Flushing Ancol dan Jembatan Merah berpotensi banjir!'
        # Waspada,Siaga,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai dan istiqlal berpotensi banjir!'
        # Waspada,Siaga,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Manggarai dan Jembatan Merah berpotensi banjir!'
        # Waspada,Waspada,Siaga,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Istiqlal dan Jembatan Merah berpotensi banjir!'
        
        # 2 Waspada 1 Siaga 1 Normal
        
        # Waspada,Waspada,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
        # Siaga,Waspada,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Siaga,Waspada,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Waspada,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Siaga,Normal,Waspada
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Normal,Siaga,Waspada,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Normal,Waspada,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Waspada,Normal,Siaga,Waspada
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
        # Normal,Waspada,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!'
        # Waspada,Waspada,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Normal,Waspada,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Waspada,Normal,Waspada,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
            
        #2 Normal 1 Siaga 1 Waspada
        
        # Normal,Normal,Siaga,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == '' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        # Siaga,Normal,Normal,Waspada
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Normal,Siaga,Normal,Waspada
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Normal,Waspada,Normal
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol warga perlu waspada!'
        # Normal,Siaga,Waspada,Normal
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Waspada,Siaga,Normal,Normal
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        # Siaga,Waspada,Normal,Normal
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # Normal,Waspada,Siaga,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!' 
        # Waspada,Normal,Siaga,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!' 
        # Normal,Normal,Waspada,Siaga
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!' 
        # Waspada,Normal,Normal,Siaga
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!' 
        # Normal,Waspada,Normal,Siaga
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        
        # 1 Siaga 3 Waspada
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Waspada' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Siaga' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
        elif fa == 'Waspada' and mg == 'Siaga' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Waspada' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # 1 Siaga 3 Normal
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Siaga':
            pesan = '[AWAS] Pada lokasi Jembatan Merah berpotensi banjir!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Siaga' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Istiqlal berpotensi banjir!!'
        elif fa == 'Normal' and mg == 'Siaga' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Manggarai berpotensi banjir!'
        elif fa == 'Siaga' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[AWAS] Pada lokasi Flushing Ancol berpotensi banjir!'
        # 2 Waspada 2 Normal
        
        # Waspada,Waspada,Normal,Normal
        elif fa == 'Waspada' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Waspada,Waspada,Normal
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Manggarai dan Istiqlal warga perlu waspada!'
        # Waspada,Normal,Waspada,Normal
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Istiqlal warga perlu waspada!'
        # Normal,Waspada,Normal,Waspada
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Manggarai dan Jembatan Merah warga perlu waspada!'
        # Waspada,Normal,Normal,Waspada
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Flushing Ancol dan Manggarai warga perlu waspada!'
        # Normal,Normal,Waspada,Waspada
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Istiqlal dan Jembatan Merah warga perlu waspada!'
        
        # 1 Waspada 3 Normal
        elif fa == 'Normal' and mg == 'Normal' and it == 'Normal' and jm == 'Waspada':
            pesan = '[AMAN] Pada lokasi Jembatan Merah warga perlu waspada!'
        elif fa == 'Normal' and mg == 'Normal' and it == 'Waspada' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Istiqlal warga perlu waspada!'
        elif fa == 'Normal' and mg == 'Waspada' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Manggarai warga perlu waspada!'
        elif fa == 'Waspada' and mg == 'Normal' and it == 'Normal' and jm == 'Normal':
            pesan = '[AMAN] Pada lokasi Flushing Ancol warga perlu waspada!'
        else:
            pesan = '[AMAN] DAS Ciliwung tidak memiliki potensi banjir!'
    return pesan

# print('''
# =============================================================
# っ◔ ◡ ◔ )っ  ♥  Early Warning System (Banjir Sungai Ciliwung)
# =============================================================
# ''')

with open("data.json", "r") as data:
    data = json.load(data)
    for i in range(len(data)):
        if i == 0:
            continue
        else:
            # Kondisi awal ketinggian lokasi pemantauan
            KatulampaAwal     = data[i-1]['Katulampa']
            FlushingAncolAwal   = data[i-1]['Flusing Ancol']
            ManggaraiAwal       = data[i-1]['Manggarai']
            IstiqlalAwal        = data[i-1]['Istiqlal']
            JembatanMerahAwal   = data[i-1]['Jembatan Merah']
            
            # Status pada kondisi ketinggian awal
            statusKatulampa         = Katulampa(KatulampaAwal)
            statusFlushingAncolAwal = FlushingAncol(FlushingAncolAwal)
            statusManggaraiAwal     = Manggarai(ManggaraiAwal)
            statusIstiqlalAwal      = Istiqlal(IstiqlalAwal)
            statusJembatanMerahAwal = JembatanMerah(JembatanMerahAwal)
            
            # Kondisi ketinggian lokasi pemantauan saat ini
            KatulampaSekarang   = data[i]['Katulampa']
            FlushingAncolSekarang = data[i]['Flusing Ancol']
            ManggaraiSekarang     = data[i]['Manggarai']
            IstiqlalSekarang      = data[i]['Istiqlal']
            JembatanMerahSekarang = data[i]['Jembatan Merah']
            
            # Status ketinggian lokasi pemantauan saat ini
            statusKatulampaSekrang      = Katulampa(KatulampaSekarang)
            statusFlushingAncolSekarang = FlushingAncol(FlushingAncolSekarang)
            statusManggaraiSekarang     = Manggarai(ManggaraiSekarang)
            statusIstiqlalSekarang      = Istiqlal(IstiqlalSekarang)
            statusJembatanMerahSekarang = JembatanMerah(JembatanMerahSekarang)
            
            # Perhitungan ketinggian lokasi pemantauan selanjutnya (Menggunakan pemanggilan fungsi)
            prediksiKatulampa       = prediksiKetinggian(KatulampaAwal,KatulampaSekarang)
            prediksiFlushingAncol   = prediksiKetinggian(FlushingAncolAwal,FlushingAncolSekarang)
            prediksiManggarai       = prediksiKetinggian(ManggaraiAwal,ManggaraiSekarang)
            prediksiIstiqlal        = prediksiKetinggian(IstiqlalAwal,IstiqlalSekarang)
            prediksiJembatanMerah   = prediksiKetinggian(JembatanMerahAwal,JembatanMerahSekarang)
            
            # Status dari prediksi ketinggian lokasi pemantauan
            statusPrediksiKatulampa     = Katulampa(prediksiKetinggian(KatulampaAwal, KatulampaSekarang))
            statusPrediksiFlushingAncol = FlushingAncol(prediksiKetinggian(FlushingAncolAwal, FlushingAncolSekarang))
            statusPrediksiManggarai     = Manggarai(prediksiKetinggian(ManggaraiAwal, ManggaraiSekarang))
            statusPrediksiIstiqlal      = Istiqlal(prediksiKetinggian(IstiqlalAwal, IstiqlalSekarang))
            statusPrediksiJembatanMerah = JembatanMerah(prediksiKetinggian(JembatanMerahAwal, JembatanMerahSekarang))
            
            # Status Pintu Air pada aliran sungai ciliwung
            pintukl = pintuAirkl(statusPrediksiKatulampa)
            pintufa = pintuAirfa(statusPrediksiFlushingAncol)
            pintumg = pintuAirmg(statusPrediksiManggarai)
            pintuit = pintuAirit(statusPrediksiIstiqlal)
            pintujm = pintuAirjm(statusPrediksiJembatanMerah)


            # Cetak output
            print("Data ke-" + str(i))
            print("Waktu : " + str(data[i]['Tanggal']) + " - " + str(data[i]['Waktu']))
            print("=============================")
            print("Ketinggian Data Sebelumnya  : %-10s %-10s %-10s %-10s %-10s" % (KatulampaAwal, FlushingAncolAwal, ManggaraiAwal, IstiqlalAwal, JembatanMerahAwal))
            print("Status Data Sebelumnya      : %-10s %-10s %-10s %-10s %-10s" % (statusManggaraiAwal, statusFlushingAncolAwal, statusManggaraiAwal, statusIstiqlalAwal, statusJembatanMerahAwal))
            print("=============================")
            print("Ketinggian Data Saat Ini    : %-10s %-10s %-10s %-10s %-10s" % (KatulampaSekarang, FlushingAncolSekarang, ManggaraiSekarang, IstiqlalSekarang, JembatanMerahSekarang))
            print("Status Data Saat Ini        : %-10s %-10s %-10s %-10s %-10s" % (statusKatulampaSekrang, statusFlushingAncolSekarang, statusManggaraiSekarang, statusIstiqlalSekarang, statusJembatanMerahSekarang))
            print("=============================")
            print("Prediksi Ketinggian         : %-10s %-10s %-10s %-10s %-10s" % (prediksiKatulampa, prediksiFlushingAncol, prediksiManggarai, prediksiIstiqlal, prediksiJembatanMerah))
            print("Data Prediksi Selanjutnya   : %-10s %-10s %-10s %-10s %-10s" % (statusPrediksiKatulampa, statusPrediksiFlushingAncol, statusPrediksiManggarai, statusPrediksiIstiqlal, statusPrediksiJembatanMerah))
            print("=============================")
            print("Pintu Air                   : %-10s %-10s %-10s %-10s %-10s" % (pintukl, pintufa, pintumg, pintuit, pintujm))
            print("=============================")
            print("Hasil Prediksi              :", prediksiBanjir(statusPrediksiKatulampa, statusPrediksiFlushingAncol, statusPrediksiManggarai, statusPrediksiIstiqlal, statusPrediksiJembatanMerah))
            print()
            time.sleep(10)