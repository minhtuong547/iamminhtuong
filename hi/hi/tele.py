import telebot
import datetime
import time
import os,sys,re
import subprocess
import requests
import datetime
import psutil
import sqlite3
import hashlib
os.system("cls" if os.name == "nt" else "clear")
banner="""
\033[1;34m╔═════════════════════════════════════════════════════════════════════════════╗
\033[1;32m║ ██╗     ██║         ║██  ║██     ██║  ══ ████████╗ ██████╗  ██████╗ ██╗        ║
\033[1;35m║ ██║      ██║       ║██   ║██   ██║    ══    ██╔══╝██╔═══██╗██╔═══██╗██        ║
\033[1;31m║ ██║       ██║     ║██    ║████║       ══    ██║   ██║   ██║██║   ██║██║       ║
\033[1;33m║ ██║        ██║   ║██     ║██  ██║     ══    ██║   ██║   ██║██║   ██║██║       ║
\033[1;34m║ ███████╗    ██║ ║██      ║██    ██║   ══    ██║   ╚██████╔╝╚██████╔╝███████╗  ║
\033[1;37m║ ╚══════╝      ═══        ═══      ══  ══    ╚═╝    ╚═════╝  ╚═════╝ ╚══════╝  ║
\033[1;34m╠═════════════════════════════════════════════════════════════════════════════╣
\033[1;32m║➢ Author   : LVK - TOOL                                          ║
\033[1;36m║➢ Youtube  : https://youtube.com/@Crowsdarkvn                    ║
\033[1;31m║➣ Nhóm Zalo  : https://zalo.me/g/ijqrry350                       ║
\033[1;33m║➣ Website  : https://crowsdark.vn                                ║
\033[1;32m║➣ Nhóm Telegram : https://t.me/spamsmsvankhanh                   ║
\033[1;34m╚═════════════════════════════════════════════════════════════════╝
\033[1;32m ➣ ➣ ➣ ➣ ➣ ➣ \033[1;33mĐang Chạy Bot Telegram \033[1;32m➣ ➣ ➣ ➣ ➣ ➣
"""
for X in banner:
  sys.stdout.write(X)
  sys.stdout.flush() 
bot_token = '6528764041:AAEaRvZdnsP-_ay67weEs9Q8vS1PVnnknK8' 
bot = telebot.TeleBot(bot_token)
processes = []
ADMIN_ID = '5540480097'

def TimeStamp():
    now = str(datetime.date.today())
    return now

@bot.message_handler(commands=['getkey'])
def startkey(message):
    bot.reply_to(message, text='VUI LÒNG ĐỢI TRONG GIÂY LÁT!')
    key = "LVK-" + str(int(message.from_user.id) * int(datetime.date.today().day) - 12666)
    key = "https://crowsdark.vn/key/key.html?key=" + key
    api_token = 'de9b6b7e2ebfb06fcb4082f034182160bd4c80d6'
    url = requests.get(f'https://octolinkz.com/api?api={api_token}&url={key}').json()
    url_key = url['shortenedUrl']
    text = f'''
- LINK LẤY KEY {TimeStamp()} LÀ: {url_key} -
- KHI LẤY KEY XONG, DÙNG LỆNH /key <key> ĐỂ TIẾP TỤC -
    '''
    bot.reply_to(message, text)


@bot.message_handler(commands=['key'])
def key(message):
    if len(message.text.split()) == 1:
        bot.reply_to(message, 'VUI LÒNG NHẬP KEY.')
        return

    user_id = message.from_user.id

    key = message.text.split()[1]
    username = message.from_user.username
    expected_key = "LVK-" + str(int(message.from_user.id) * int(datetime.date.today().day) - 12666)
    if key == expected_key:
        bot.reply_to(message, 'KEY HỢP LỆ. BẠN ĐÃ ĐƯỢC PHÉP SỬ DỤNG LỆNH /spam.')
        fi = open(f'./user/{datetime.date.today().day}/{user_id}.txt',"w")
        fi.write("")
        fi.close()
    else:
        bot.reply_to(message, 'KEY KHÔNG HỢP LỆ.')
        
@bot.message_handler(commands=['vip'])
def vip(message):
    user_id = message.from_user.id
    if not os.path.exists(f"./vip/{user_id}.txt"):
        bot.reply_to(message, 'Bạn chưa đăng ký VIP, vui lòng liên hệ admin')
        return

    fo = open(f"./vip/{user_id}.txt")
    data = fo.read().split("|")
    qua_khu = data[0]
    ngay_hien_tai = datetime.date.today()

    # Convert the date strings to datetime objects for comparison
    qua_khu_date = datetime.datetime.strptime(qua_khu, '%Y-%m-%d').date()

    so_ngay = (ngay_hien_tai - qua_khu_date).days

    if so_ngay < 0:
        bot.reply_to(message, 'Key VIP cài vào ngày khác')
        return

    hethan_date = datetime.datetime.strptime(data[1], '%Y-%m-%d').date()

    if ngay_hien_tai > hethan_date:
        bot.reply_to(message, 'Key VIP đã hết hạn. Vui lòng liên hệ admin.')
        os.remove(f"./vip/{user_id}.txt")
        return

    # Check command arguments
    if len(message.text.split()) != 3:
        bot.reply_to(message, 'Vui lòng nhập đúng cú pháp: /vip[số điện thoại] [số lần spam]')
        return

    lap = message.text.split()[2]
    if not lap.isnumeric():
        bot.reply_to(message, "Sai dữ kiện !!!")
        return

    phone_number = message.text.split()[1]
    if not re.search("^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$", phone_number):
        bot.reply_to(message, 'SỐ ĐIỆN THOẠI KHÔNG HỢP LỆ !')
        return

    if phone_number in ["0365956335"]:
        bot.reply_to(message, "Spam cái đầu buồi tao huhu")
        return

    file_path = os.path.join(os.getcwd(), "sms1.py")
    process = subprocess.Popen(["python", file_path, phone_number, lap])
    processes.append(process)
    bot.reply_to(message, f'https://chuotdev.000webhostapp.com/GaiXinh18.mp4\n🚀 Gửi Yêu Cầu Tấn Công Thành Công 🚀 \n+ Bot 👾: @LVK_TOOLS_bot \n+ Số Tấn Công 📱: [ {phone_number} ]\n+ Lặp lại : {lap}\n+ Chủ sở hữu 👑: @spamsmsvankhanh\n+ Website : https://crowsdark.vn/key/key.html\n+ Plan : VIP')
  
@bot.message_handler(commands=['spam'])
def spam(message):
    user_id = message.from_user.id
    if not os.path.exists(f"./user/{datetime.date.today().day}/{user_id}.txt"):
      bot.reply_to(message, 'Dùng /getkey để lấy key và dùng /key để nhập key hôm nay')
      return
    if len(message.text.split()) == 1:
        bot.reply_to(message, 'VUI LÒNG NHẬP SỐ ĐIỆN THOẠI + SỐ LẦN ')
        return
    if len(message.text.split()) == 2:
        bot.reply_to(message, 'Thiếu dữ kiện !!!')
        return
    lap = message.text.split()[2]
    if lap.isnumeric():
      if not (int(lap) > 0 and int(lap) <= 40):
        bot.reply_to(message,"Vui lòng spam trong khoảng 1-40. Nếu nhiều hơn mua vip để sài :))")
        return
    else:
      bot.reply_to(message,"Sai dữ kiện !!!")
      return
    phone_number = message.text.split()[1]
    if not re.search("^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$",phone_number):
        bot.reply_to(message, 'SỐ ĐIỆN THOẠI KHÔNG HỢP LỆ !')
        return

    if phone_number in ["0365956335"]:
        # Số điện thoại nằm trong danh sách cấm
        bot.reply_to(message,"Spam cái đầu buồi tao huhu")
        return

    file_path = os.path.join(os.getcwd(), "sms1.py")
    process = subprocess.Popen(["python", file_path, phone_number, lap])
    processes.append(process)
    bot.reply_to(message, f'https://chuotdev.000webhostapp.com/GaiXinh18.mp4\n🚀 Gửi Yêu Cầu Tấn Công Thành Công 🚀 \n+ Bot 👾: @LVK_TOOLS_bot \n+ Số Tấn Công 📱: [ {phone_number} ]\n+ Lặp lại : {lap}\n+ Chủ sở hữu 👑: @spamsmsvankhanh\n+ Website : https://crowsdark.vn/key/key.html\n+ Plan : FREE')
  
@bot.message_handler(commands=['help'])
def help(message):
    help_text = '''
Danh sách lệnh:
- /getkey: Lấy key để sử dụng các lệnh.
- /key {key}: Kiểm tra key và xác nhận quyền sử dụng các lệnh.
- /spam {số điện thoại} {so lan}: Gửi tin nhắn SMS Call.
- /vip {số điện thoại} {so lan}: Gửi tin nhắn SMS Call.(vip)
- /help: Danh sách lệnh.
- /mua : Mua Bot
- /status (admin)
- /restart (admin)
- /stop (admin)
- /them (admin)
'''
    bot.reply_to(message, help_text)
    
# status
@bot.message_handler(commands=['status'])
def status(message):
    user_id = message.from_user.id
    if str(user_id) != ADMIN_ID:
        bot.reply_to(message, 'Bạn không có quyền sử dụng lệnh này.')
        return
    process_count = len(processes)
    bot.reply_to(message, f'Số quy trình đang chạy: {process_count}.')



# khoir dong lai bot
@bot.message_handler(commands=['restart'])
def restart(message):
    user_id = message.from_user.id
    if str(user_id) != ADMIN_ID:
        bot.reply_to(message, 'Bạn không có quyền sử dụng lệnh này.')
        return
    bot.reply_to(message, 'Bot sẽ được khởi động lại trong giây lát...')
    time.sleep(2)
    python = sys.executable
    os.execl(python, python, *sys.argv)


# stop chuongw trinhf
@bot.message_handler(commands=['stop'])
def stop(message):
    user_id = message.from_user.id
    if str(user_id) != ADMIN_ID:
        bot.reply_to(message, 'Bạn không có quyền sử dụng lệnh này.')
        return
    bot.reply_to(message, 'Bot sẽ dừng lại trong giây lát...')
    time.sleep(2)
    bot.stop_polling()
@bot.message_handler(commands=['them'])
def them(message):
    user_id = message.from_user.id
    if str(user_id) != ADMIN_ID:
        bot.reply_to(message, 'Bạn không có quyền sử dụng lệnh này.')
        return
    idvip = message.text.split(" ")[1]
    ngay = message.text.split(" ")[2]
    hethan = message.text.split(" ")[3]
    fii = open(f"./vip/{idvip}.txt","w")
    fii.write(f"{ngay}|{hethan}")
    bot.reply_to(message, f'Thêm Thành Công {idvip} Làm Vip')

# mua
@bot.message_handler(commands=['mua'])
def mua(message):
    reply_text = 'Giá cả của các gói dịch vụ tất cả đều chát /admin:\n\n'
    reply_text += '- Gói /spam: 15k/1 tháng\n'
    reply_text += '- Mua suộc bot giống bot 150k Không giới hạn\n'
    bot.reply_to(message, reply_text)


# lenh lo 
@bot.message_handler(func=lambda message: True)
def echo_all(message):
    bot.reply_to(message, 'Lệnh không hợp lệ. Vui lòng sử dụng lệnh /help để xem danh sách lệnh.') 
       
bot.infinity_polling(timeout=60, long_polling_timeout = 1)
