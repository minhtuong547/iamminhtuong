import telegram
import datetime
import time
import os
import subprocess
import psutil
import base64
import requests
import sqlite3
import urllib3
import requests
import hashlib
from telegram.ext import Updater, CommandHandler, MessageHandler, Filters

from keep_alive import keep_alive

keep_alive()
bot_token = '6984012778:AAEhira9TdG_PikjqkUqeB7uu1XR8vTC2W8'  # Thay YOUR_BOT_TOKEN bằng mã token của bot Telegram của bạn
bot = telegram.Bot(token=bot_token)

allowed_group_id = -1001937272943 

allowed_users = []
processes = []
ADMIN_ID = 6399418466  # Thay 123456789 bằng ID của admin

# Kết nối đến cơ sở dữ liệu SQLite
connection = sqlite3.connect('user_data.db')
cursor = connection.cursor()

# Tạo bảng người dùng nếu chưa tồn tại
cursor.execute('''
    CREATE TABLE IF NOT EXISTS users (
        user_id INTEGER PRIMARY KEY,
        expiration_time TEXT
    )
''')
connection.commit()

def load_users_from_database():
    cursor.execute('SELECT user_id, expiration_time FROM users')
    rows = cursor.fetchall()
    for row in rows:
        user_id = row[0]
        expiration_time = datetime.datetime.strptime(row[1], '%Y-%m-%d %H:%M:%S')
        if expiration_time > datetime.datetime.now():
            allowed_users.append(user_id)

def save_user_to_database(connection, user_id, expiration_time):
    cursor = connection.cursor()
    cursor.execute('''
        INSERT OR REPLACE INTO users (user_id, expiration_time)
        VALUES (?, ?)
    ''', (user_id, expiration_time.strftime('%Y-%m-%d %H:%M:%S')))
    connection.commit()

def add_user(update, context):
    admin_id = update.message.from_user.id
    if admin_id != ADMIN_ID:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return

    if len(context.args) == 0:
        update.message.reply_text('Vui lòng nhập ID người dùng.')
        return

    user_id = int(context.args[0])
    allowed_users.append(user_id)
    # Lưu thông tin người dùng vào cơ sở dữ liệu với thời gian hết hạn là sau 30 ngày
    expiration_time = datetime.datetime.now() + datetime.timedelta(days=30)
    connection = sqlite3.connect('user_data.db')
    save_user_to_database(connection, user_id, expiration_time)
    connection.close()

    update.message.reply_text(f'Người dùng có ID {user_id} đã được thêm vào danh sách được phép sử dụng lệnh /vip')

# Gọi hàm load_users_from_database để tải danh sách người dùng từ cơ sở dữ liệu
load_users_from_database()

def sms(update, context):
    # Kiểm tra xem người dùng có trong danh sách được phép hay không
    user_id = update.message.from_user.id
    if user_id not in allowed_users:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này liên hệ admin để mua hoặc dùng lệnh /getkey để lấy key và lệnh /key để nhập key ví dụ /key keyhomnay.')
        return
    # Kiểm tra xem bot đang hoạt động trong nhóm đúng hay không
    if update.message.chat_id != allowed_group_id:
        update.message.reply_text('Bot chỉ hoạt động trong nhóm này https://t.me/spamminhtuong')
        return

    # Kiểm tra xem thời gian giữa các lần sử dụng lệnh có đủ lớn không
    current_time = time.time()
    last_used_time = context.user_data.get('last_used_time', 0)
    if current_time - last_used_time < 60:
        # Thông báo cho người dùng rằng cần đợi để sử dụng lại lệnh
        remaining_time = int(60 - (current_time - last_used_time))
        context.bot.send_message(chat_id=update.effective_chat.id,
                                 text=f"Bạn cần đợi {remaining_time} giây trước khi sử dụng lại lệnh.")
        return

    if len(context.args) == 0:
        context.bot.send_message(chat_id=update.effective_chat.id, text="Vui lòng nhập số điện thoại cần spam.")
        return

    phone_number = context.args[0]

    if phone_number in ['113', '113','03','911','114','115','5','','091','0974707985','0915215448','0376017413']:
        # Số điện thoại nằm trong danh sách cấm
        context.bot.send_message(chat_id=update.effective_chat.id,
                                 text="Spam cái đầu buồi tao ban mày luôn bây giờ")
        return

    user_mention = update.message.from_user.mention_html()
    hi = f'''🚀 Tấn công thành công 🚀 
https://chuotdev.000webhostapp.com/GaiXinh18.mp4    
Bot 👾:@spamminhuong
Số tấn công 📱: [ {phone_number} ] 
Người yêu cầu {user_mention}
Lập lại ⚔️: [ 40 ]
Gói 💸:  [ FREE ]
Thời gian chờ ⏱️: [ 60s ]
🤖 BOT DÙNG RIÊNG: @MissGeneral_bot
Chủ sở hữu 👑: @domotoit
Website: https://www.sieutuoiteen.com/2024/01/key.html
'''

    update.message.reply_text(text=hi, parse_mode=telegram.ParseMode.HTML)
    context.user_data['last_used_time'] = current_time

    # Chạy file sms.py
    file_path = os.path.join(os.getcwd(), "sms1.py")
    process = subprocess.Popen(["python", file_path, phone_number, "40"])
    processes.append(process)

def vip(update, context):
    # Kiểm tra xem người dùng có trong danh sách được phép hay không
    user_id = update.message.from_user.id
    if user_id not in allowed_users:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return
    # Kiểm tra xem bot đang hoạt động trong nhóm đúng hay không
    if update.message.chat_id != allowed_group_id:
        update.message.reply_text('Bot chỉ hoạt động trong nhóm này https://t.me/spamminhtuong')
        return    
    # Kiểm tra xem thời gian giữa các lần sử dụng lệnh có đủ lớn không
    current_time = time.time()
    last_used_time = context.user_data.get('last_used_time', 0)
    if current_time - last_used_time < 5:
        # Thông báo cho người dùng rằng cần đợi để sử dụng lại lệnh
        remaining_time = int(5 - (current_time - last_used_time))
        context.bot.send_message(chat_id=update.effective_chat.id,
                                 text=f"Bạn cần đợi {remaining_time} giây trước khi sử dụng lại lệnh.")
        return
    if len(context.args) == 0:
        context.bot.send_message(chat_id=update.effective_chat.id, text="Vui lòng nhập số điện thoại cần spam.")
        return

    phone_number = context.args[0]

    user_mention = update.message.from_user.mention_html()
    hi = f'''🚀 Tấn công thành công 🚀 
https://hdttool2023.000webhostapp.com/+.mp4    
Bot 👾:@spamminhtuong
Số tấn công 📱: [ {phone_number} ] 
Lập lại ⚔️: [ 200 ]
Gói 💸:  [ VIP ]
Thời gian chờ ⏱️: [ 5s ]
🤖 BOT DÙNG RIÊNG: @MissGeneral_bot
Chủ sở hữu 👑: @domotoit
Website: https://www.sieutuoiteen.com/2024/01/key.html

'''

    update.message.reply_text(text=hi, parse_mode=telegram.ParseMode.HTML)

    # Chạy file sms.py
    file_path = os.path.join(os.getcwd(), "sms.py")
    process = subprocess.Popen(["python", file_path, phone_number, "120"])
    processes.append(process)

def help_to(update, context):
    help_text = '''
    Cách sử dụng các lệnh của bot:
    - /getkey: Để lấy key spam free
    - /key <key vừa lấy> để xác thực key
    - /sms <số điện thoại>: Gửi tin nhắn spam đến số điện thoại.
    - /vip <số điện thoại>: Gửi tin nhắn spam đến số điện thoại (chỉ người dùng được phép).
    - /admin: Hiển thị thông tin admin.
    - /grant: Cấp quyền sử dụng lệnh /vip mà không cần đợi thời gian giữa các lần sử dụng.
    - /adduser <user_id>: Thêm người dùng vào danh sách được phép sử dụng lệnh /vip (chỉ admin).
    - /help: Xem cách sử dụng các lệnh của bot.
    - /cpu: Xem thông tin về thời gian hoạt động, % CPU, % Memory, % Disk đang sử dụng của bot.
    - /stop: Dừng lại tất cả các tệp  đang chạy.
    '''
    update.message.reply_text(text=help_text)

def cpu(update, context):
    uptime = datetime.datetime.now() - datetime.datetime.fromtimestamp(psutil.boot_time())
    uptime_text = f"Bot đã hoạt động trong {uptime}"

    cpu_usage = psutil.cpu_percent()
    cpu_text = f"CPU Đang Dùng: {cpu_usage}%"

    memory_usage = psutil.virtual_memory().percent
    memory_text = f"Memory Đang Dùng: {memory_usage}%"

    disk_usage = psutil.disk_usage('/').percent
    disk_text = f"Disk Đang Dùng: {disk_usage}%"

    status_text = f"{uptime_text}\n{cpu_text}\n{memory_text}\n{disk_text}"
    update.message.reply_text(text=status_text)

def admin_info(update, context):
    admin_name = '''- ADMIN 👾💻
    + Administrator :@domotoit
    ''
    +  Website : box https://iamminhtuong.vn'''

    message = f"{admin_name}\n {admin_contact}"
    update.message.reply_text(text=message)

def grant_permission(update, context):
    user_id = update.message.from_user.id
    if user_id != ADMIN_ID:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return

    if len(context.args) == 0:
        update.message.reply_text('Vui lòng nhập ID người dùng.')
        return

    user_id = int(context.args[0])
    allowed_users.append(user_id)
    update.message.reply_text(f'Người dùng có ID {user_id} đã được cấp quyền sử dụng lệnh /vip mà không cần đợi thời gian giữa các lần sử dụng.')

def stop(update, context):
    user_id = update.message.from_user.id
    if user_id not in allowed_users:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return

    for process in processes:
        process.kill()

    update.message.reply_text('Đã dừng lại tất cả các tệp đang chạy.')

def remove_user(update, context):
    admin_id = update.message.from_user.id
    if admin_id != ADMIN_ID:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return

    if len(context.args) == 0:
        update.message.reply_text('Vui lòng nhập ID người dùng.')
        return

    user_id = int(context.args[0])
    if user_id in allowed_users:
        allowed_users.remove(user_id)
        connection = sqlite3.connect('user_data.db')
        cursor = connection.cursor()
        cursor.execute('DELETE FROM users WHERE user_id = ?', (user_id,))
        connection.commit()
        connection.close()
        update.message.reply_text(f'Người dùng có ID {user_id} đã được xóa khỏi danh sách được phép sử dụng lệnh /vip.')
    else:
        update.message.reply_text(f'Người dùng có ID {user_id} không tồn tại trong danh sách được phép sử dụng lệnh /vip.')

def user_list(update, context):
    admin_id = update.message.from_user.id
    if admin_id != ADMIN_ID:
        update.message.reply_text('Bạn không có quyền sử dụng lệnh này.')
        return

    if len(allowed_users) == 0:
        update.message.reply_text('Danh sách người dùng được phép sử dụng lệnh /vip hiện đang trống.')
        return

    user_list_text = 'Danh sách người dùng được phép sử dụng lệnh /vip:\n'
    for user_id in allowed_users:
        user = bot.get_chat_member(allowed_group_id, user_id)
        user_list_text += f'- ID: {user.user.id}, Tên: {user.user.first_name} {user.user.last_name}\n'
    update.message.reply_text(user_list_text)

def plan(update, context):
    reply_text = 'Giá cả của các gói dịch vụ tất cả đều chát admin @:\n\n'
    reply_text += '- Gói /vip: /1 tháng\n'
    reply_text += '- Gói /vip: /6 tháng\n'
    reply_text += '- Gói /vip: /1 năm\n'
    reply_text += '- Gói /vip: / Không giới hạn\n'
    update.message.reply_text(reply_text)

def generate_key(user_id):
    today = datetime.date.today().strftime("%Y-%m-%d")
    key_string = f"{user_id}-{today}"
    key = hashlib.sha256(key_string.encode()).hexdigest()
    return key

def process_key(update, context):
    text = update.message.text.split()

    if len(text) >= 2 and text[0].strip() == "/key":
        key = text[1].strip()

        if key == "":
            update.message.reply_text('Vui lòng nhập key. Ví dụ: /key keycuaban\nNếu bạn chưa nhận key, vui lòng nhấp /getkey để nhận key.')
        else:
            encoded_user_id = base64.b64encode(str(update.effective_user.id).encode()).decode()

            if key == generate_key(encoded_user_id):
                # Xác thực key thành công
                connection = sqlite3.connect('user_data.db')
                expiration_time = datetime.datetime.now() + datetime.timedelta(days=1)
                user_id = update.effective_user.id
                allowed_users.append(user_id)
                save_user_to_database(connection, user_id, expiration_time)
                connection.close()

                # Số lượng người dùng đã xác thực key
                num_users = len(allowed_users)

                update.message.reply_text(f'Xác thực key thành công. Cảm ơn  đã ủng hộ. Hiện có {num_users} người đã xác thực key bây giờ bạn có thể dùng lệnh /sms.')
            else:
                update.message.reply_text('Xác thực key thất bại. Nếu  chưa nhận key, vui lòng nhấp /getkey để nhận key.')

def get_key(update, context):

    # Mã hóa id người dùng lệnh
    encoded_id = base64.b64encode(str(update.effective_user.id).encode()).decode()
    key = generate_key(encoded_id)

    long_url = f"https://www.sieutuoiteen.com/2024/01/key.html?key={key}"
    api_token = '6553458e1a394d43e453e66f'
    url = requests.get(f'https://link4m.co/api-shorten/v2?api={api_token}&url={long_url}').json()
    link = url['shortenedUrl']

    # Gửi giá trị của biến link về cho người dùng
    update.message.reply_text(f"Link key của bạn là: {link} Sau Khi Bạn Vượt Link Thành Công, Bạn Hãy Bấm: [/key keyhomnay] Để Xác Thực Key")

def main():
    updater = Updater(token=bot_token, use_context=True)
    dispatcher = updater.dispatcher

    help_handler = CommandHandler('start', help_to)
    dispatcher.add_handler(help_handler)

    sms_handler = CommandHandler('sms', sms)
    dispatcher.add_handler(sms_handler)

    vip_handler = CommandHandler('vip', vip)
    dispatcher.add_handler(vip_handler)

    admin_handler = CommandHandler('admin', admin_info)
    dispatcher.add_handler(admin_handler)

    grant_handler = CommandHandler('grant', grant_permission)
    dispatcher.add_handler(grant_handler)

    add_user_handler = CommandHandler('adduser', add_user)
    dispatcher.add_handler(add_user_handler)

    help_handler = CommandHandler('help', help_to)
    dispatcher.add_handler(help_handler)

    cpu_handler = CommandHandler('cpu', cpu)
    dispatcher.add_handler(cpu_handler)

    stop_handler = CommandHandler('stop', stop)
    dispatcher.add_handler(stop_handler)

    remove_user_handler = CommandHandler('removeuser', remove_user)
    dispatcher.add_handler(remove_user_handler)

    user_list_handler = CommandHandler('userlist', user_list)
    dispatcher.add_handler(user_list_handler)

    plan_handler = CommandHandler('plan', plan)
    dispatcher.add_handler(plan_handler)

    key_handler = CommandHandler('key', process_key)
    dispatcher.add_handler(key_handler)

    getkey_handler = CommandHandler('getkey', get_key)
    dispatcher.add_handler(getkey_handler)

    updater.start_polling()

if __name__ == '__main__':
    main()
from replit import db
