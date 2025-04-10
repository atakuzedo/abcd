def celsius_to_fahrenheit(c):
    return (c * 9/5) + 32

def celsius_to_kelvin(c):
    return c + 273.15

def celsius_to_reamur(c):
    return c * 4/5

def main():
    while True:
        print("KONVERSI CELSIUS (C) KE?")
        print("A. FAHRENHEIT (F)")
        print("B. KELVIN (K)")
        print("C. REAMUR (R)")
        
        pilihan = input("INPUT PILIHAN (A/B/C)? ").upper()
        suhu_celsius = float(input("MASUKKAN SUHU (C)? "))
        
        if pilihan == 'A':
            suhu_fahrenheit = celsius_to_fahrenheit(suhu_celsius)
            print(f"SUHU DALAM (F) ADALAH {suhu_fahrenheit}")
        elif pilihan == 'B':
            suhu_kelvin = celsius_to_kelvin(suhu_celsius)
            print(f"SUHU DALAM (K) ADALAH {suhu_kelvin}")
        elif pilihan == 'C':
            suhu_reamur = celsius_to_reamur(suhu_celsius)
            print(f"SUHU DALAM (R) ADALAH {suhu_reamur}")
        else:
            print("Pilihan tidak valid!")
            continue

        konversi_lagi = input("KONVERSI SUHU LAGI (Y/T)? ").upper()
        if konversi_lagi != 'Y':
            break

if __name__ == "__main__":
    main()