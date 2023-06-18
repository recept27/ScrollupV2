import os
import requests
import subprocess
import time
import datetime
import threading
import json
import psutil

data_file = "data.json"
error_image_path = "/home/user/Desktop/ScrollUp/default.png"
vlc_process = None
vlc_error_process = None
error_image_thread = None

def stop_vlc():
    print("stop_vlc")
    global vlc_error_process
    global vlc_process
    if vlc_process is not None:
        print("stop_vlc vlc_process")
        vlc_process.terminate()
        vlc_process = None

    if vlc_error_process is not None:
        print("stop_vlc vlc_error_process")
        vlc_error_process.terminate()
        vlc_error_process = None

def start_vlc(playlist):
    print("start_vlc")
    global vlc_process
    vlc_process = subprocess.Popen(['cvlc', '--no-video-title-show', '-f', '--loop', '--playlist-enqueue'] + playlist)

def check_playlist_updates(url):
    try:
        response = requests.get(url)
        response.raise_for_status()

        data = response.json()
        print(data)

        current_data = load_data()

        if current_data is None:  # İlk defa verileri güncelliyorsa
            playlist = []

            for item in data:
                file_url = item['url']
                loop = item['loop']

                file_path = download_file(file_url)

                playlist.extend([file_path] * loop)

            save_data(data)

            stop_vlc()
            start_vlc(playlist)


        elif current_data != data:  # Veriler değiştiyse

            playlist = []

            # Mevcut verilerdeki dosya URL'lerinin bir kümesini oluştur

            current_urls = {item['url'] for item in current_data}

            for item in data:

                file_url = item['url']

                loop = item['loop']

                if file_url in current_urls:

                    file_path = get_file_path(file_url)

                else:

                    file_path = download_file(file_url)

                playlist.extend([file_path] * loop)

            save_data(data)

            stop_vlc()

            start_vlc(playlist)



        else:  # Veriler değişmediyse
            print("Güncellenecek Veri Yok")

    except Exception as e:
        print("Bir hata oluştu:", str(e))
        display_error_image()

def check_playlist_updates_loop(url):
    while True:
        try:
            check_playlist_updates(url)
        except Exception as e:
            print("Hata durumunda hata resmi gösteriliyor...")
            display_error_image()
            print("Tekrar deneme için 30 saniye bekleniyor...")
            time.sleep(5)
            continue

        time.sleep(5)

def download_file(url):
    try:
        response = requests.get(url)
        response.raise_for_status()

        file_name = os.path.basename(url)
        with open(file_name, 'wb') as file:
            file.write(response.content)

        print("Dosya indirildi:", file_name)
        return file_name

    except Exception as e:
        print("Dosya indirilemedi:", str(e))
        return error_image_path

def get_file_path(file_url):
    return os.path.basename(file_url)

def load_data():
    if os.path.exists(data_file):
        with open(data_file, 'r') as file:
            return json.load(file)
    return {}

def save_data(data):
    with open(data_file, 'w') as file:
        json.dump(data, file)

def display_error_image():
    print("display_error_image")
    global error_image_thread
    global vlc_process
    if vlc_process is None:
        print("vlc_process calismiyor")
        if error_image_thread is None or not error_image_thread.is_alive():
            error_image_thread = threading.Thread(target=show_error_image)
            error_image_thread.start()
    else:
        print("vlc_process calisiyor hata ekranı gösterilmedi")

def show_error_image():
    stop_vlc()
    global vlc_error_process
    vlc_error_process = subprocess.call(['cvlc', '--loop', '-f', '--no-video-title-show', error_image_path])

def check_and_play(url):
    if os.path.exists(data_file):
        # Yeni başlatılan bir bilgisayar için önceki verileri kullanarak çalma listesini çalıştır
        current_data = load_data()
        playlist = []

        for item in current_data:
            file_url = item['url']
            loop = item['loop']
            file_path = get_file_path(file_url)
            playlist.extend([file_path] * loop)

        stop_vlc()
        start_vlc(playlist)

    while True:
        try:
            check_playlist_updates(url)
        except Exception:
            pass

        time.sleep(5)


check_and_play("https://panel.firstrip.com.tr/api/?scrollup_id=1")
