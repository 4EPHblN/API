<?php
namespace OpenCartWebAPI;

define('INSTALLER_VERSION', 'v1.0');
define('INSTALLER_STEPS_COUNT', 5);
define('INSTALLER_CONFIG_ABS_FILE', realpath('../' . INSTALLER_VERSION . '/config/config.php'));

$TITLES = array(
    '1' => 'Лицензионное соглашение',
    '2' => 'Настройка конфигурации',
    '3' => 'Настройка соединения с базой данных',
    '4' => 'Доверенные устройства',
    '5' => 'Завершение установки',
);

$IMAGES = array(
    'remove' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAQAAABLCVATAAAAtUlEQVR4Ae2Tt2GDUBBAX8kMNIQh7Hks6Qago/xjMYS0g+iUtcGh4JzvB2e/i9UjfOCfKDJa3INoycI0HcOT6Owqx2AM94NE6XGGsGB5sH/RXazQu11ZhYrmVAh6oxFq+hDRkhIAQVEEgJqVv0gZcY0gd5uGPJoy5iGChr5sRZ5ovlakSIpHUyTNy15Rpzn+gZ46/INM+4sYwoS+q1FMzN4VTTFxyf5NzZ4LjOQ0uFeiIeefIA7ws4JwHtAF0AAAAABJRU5ErkJggg==',
    'success' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAFEElEQVR42uzdS3LiVhSA4QPGTqqTaaYZRGvoGYMeZEBSWbAWoG0wyBriRxvzyMCXjoxpghEv3fv9VZRslV0lHfgsQRk0WK1WIWl7QyOQAJEAkQCRAJEAkQCRAJEAkQCRBIgEiASIBIgEiASIBIgEiASIBIgkQCRAJEAkQCRAJEAkQCRAJEAkASLt0Wjbyr/+/mIy6lPra3gMDvnlumrerZvP598HIvUQR0TEqq6am/XXk+m488VvnGIpFxwRETGZjhfpD/9NXTVDQATHeyTPEXEbEcOuSABRVjha' .
        'SB4j4q4rEkCUHY4WkoeuSABRljiOhQQQZYvjGEgAUdY4uiIBRNnj6IIEEBWB41AkgKgYHIcgAURF4diGZJcDQFQcjo8gAURF4tgXif/mVbE4Wv2YlrO0HStABMd//ZS2YbmxdIqlsnHUVfM5HUHuIuImNt50BYhKxvF7Oou6TTiGgAiOVxx/pFOpZUQs2qdVgKh0HH9GxEtEPEfE17R8aUEBREXjmCUYDxFxn5bPETGPjVexAFGpOO4j4p+0fErrF5vbCIhKx/GY1r87egAiOHbgAERw7MABiODYgQMQFY/j/z59ERDBAYjg+DgOQAQHIILjMByACA5ABMfh1woBRHAAIjgAERxHxQGI4ABEcAAiOI6OAxDBAYjgAERwBCCC44w4ABEcgAgOQAQHIILjnDgAERyACA5ABAcgggMQwXElOACBAw5ABAcgggMQwQGI4ABEcFw/DkDggAMQOOAARHAAIjgAERyACA5ABEevcQACBxyAwAEHIHDAcZJGp7rj6qr5hi+HQcFRHo5jH0HeDGQyHS8TwGEbi+AoEcjWgUym41lE3EbEDSRwlApk50Am0/FTRNxBAkeJQPYayGQ6vocEjtKAfGggkMBREpCDBgIJHCUA6TQQSODIGchRBgIJHDkCOepAIIEjJyAnGQgkcOQA5KQDgQSOPgM5y0AKRwJHT4GcdSCFIoGjp0AuMpDCkMCR0ZN0SOAApDXAG0jgCH33CDKoq+YTJHAAsnugv0ACByDb78xlRMzrqvkVEjgA2Q7kJSK+1lXzGyRwAPK2RQLyFBEPddVUkMABSHz7FJJVGuAsDfQeEjgAgQQO7XWKBQkcgOzxYIQEDkAggUMHAoEEDkAggUPdgEACByCQwKFuQCCBAxBI4FD' .
        '3dxQWhgQOQCCBQ0cFUgASOACBBA6dFEiGSOAA5CQPxhyQwKHTfS5Wz5HAodMC6TESOHQeIH1CUlfNAA6dHUhfkEym4yUcugiQa0cymY5ncOiiQK4ZCRy6CiCQwAEIJHAAAgkcgEACByCX3oCSkMABCCRwAAIJHIBAAoeu8iq32SCBAxBI4AAEEjgAgQQO9QtI35DAAQgkcAACCRzqGZBrRQIHIJDAAQgkcCgTIJdGAgcgkMChvgM5NxI4AIEEDuUG5NRI4AAEEjiUO5BjI4FDwxx36hhI4FC2QLoigUPZAzkUCRwqBshHkdRVM4FDRQHZF0ldNV8SjEc4tG6wWr2/v0ejUbb7m26jeL1wzqeI+Dktf0g/89xC8gZHXPgKVDpf8/n81UJh+71+gM831s0TmEggntINjsIbFbjPm0jWQEat9bOIeIFDo0L3u41kFRGL1vOxZfp+AYdGBe/7+oG/xjDYWA+HigayiWATiLT9VSxJrw2NQAJEAkQCRAJEAkQCRAJEAkQCRBIgEiASIBIgEiASIBIgEiBSAf07AO506033lm1JAAAAAElFTkSuQmCC',
    'failure' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAYAAACtWK6eAAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAclElEQVR42uyde1wTV9rHT5LJ5EIyUC6KIgIFFKggIihV8VoULRXrK2q7uFahrNhig93s7tvX3Xffvrv9dEsvtBbZl2pru6y1atlq0Y12KXgFb2ihIFoQLGIBESUht0km8/5Rde1dO2dmTpLz+0/85ORkzvOd53lmnvMcCcuyAAsL6/slxZcACwsDgoWFAcHCwoBgYWFAsLAwIFhYGBAsLAwIFhYGBAsLA4KFhYUBwcLCgGBhYUCwsDAgWFgYECws9ERwHaArKAhfxZ8hSq8n2aGhpbf/wDCUy2h8' .
        'UKJUXpKoVK23/ixRKE4ZS0pa8RW7d4Vevcp5DAnXDVMYkO9KW1iYyprNGazFMpa5enU8OzR0n2twkHJevKhmaZrbHS0iwi7Vaq3SoKCvpL6+X0rU6jYpRX1q2rSpEl95DAh6nkCnG+4yGguYnp75TFdXjLOzU+symSRizEUeE2ORjRhxRRYSsl8WEPCO8fXXT2NAMCBCh0Ya18DAU66rVxc4OzsT6MZGP2Tj59BQBzFmTBsRErJP6u+/2dtCNQyIcF4ixtnd/YKzvX264/PPA7iGSaIBExFhlz/wwBli9OhibwjJMCD8egp/V2/vc45z51bYGxqGAYbxqN9HREbayPHjq4nRo58zlpQ0YkAwIHclTV7eOmdHxxr6xIkYsXIJoaVISekjxo7dKRsx4g/G4uIBDAgG5DuJtrO7u8x+7NgjTHc3AbxUErWaVU6b1iSPiSk0vvHGIQyIlwNC6XQxjgsX3rUfPpziLd7irr3KlCmXyXHjnjeVl7+FAfEyQCidLsbR2vq+rbY2kbXZMA0/IjI5uV+RklJkKiurwIB4OCBUUVGo4/z5Xbba2hTWYsEe4148yuTJPWRSks5UVvYBBsTDAKH0epLp6nrXajAsc924gcHgIFV6erM8Pj7L+Oqr7RgQDwBEk5f3rK26+s/Ojg4FNm84kmq1rHLevI+JiIhsY3ExjQFxQ0CooqJQ+rPP/mX79NMx2KT5kTw62qpMT89B9aUjBuSHvMbKlS9a9+7VM/39uJyfb8lkQDV/fr08NvZh1N6hYEC+7TV0uuH06dP1tsOHw7HlCisiMtKmmjfvFyh5EwzIHdLm5z9p2bt3kze/6BNbEqUSqDIz91h27crCgCAEiHrx4irL7t0Po1ovJY+OtkqDgq5' .
        'J/f0vSzWatm9vigIE0WbauLH+NuyFhanA6Yy69W/Wao1hbbYw19BQlGtgYJTr6tUAxxdfqFAFRZGS0qeYNi3Z+NprXRgQEQGhdLrh9vr6Bnt9/UhUjINMSLhBhIc3SgMDayRqdb3pzTcNvHnNp5/OYC2WVFd//yxnZ2cC3dzsh8pNgggNdageeWS5mCGXVwOiLSycY92zZ5/z0iVSVO8QE2MhoqIaZcOH75X6+28SM1Gl9Hp/18DAWqa392Fne3u849w5H7FDLp+lS18Zeu+9X2NAhIRjzZpV5h07NrsGBqRiQSGPj99PhIQ8h/ImpFv7WBxNTfMcra1q0ULg7Ox/WHbuXIwBEUCavLxnzdu2FQtdKiIbNowhJ02qJ8LD/8Rn2MRnOObs7NxAnziRyvT1yYT+ftWCBSes+/ZNxoDwKJ8VK0osH3zwjJA7+siEhBtkSsqLQ1u2/AV4iDS5ub+lT578ndDbhZWzZrWRyckPCPX23asA8Vm6dId5x45sIZ/EkBMmbHDncu+f9Cr5+U/Sn332vP348WDBruvkyT2K6dMfECJX8xpAVJmZR6xVVVMFuculpXXK4+Of9aY2Otq1axc7mppeEeoFKxkfb1SmpyfxXfDoFYCoMjPrrFVVqbwn3nFxJuXMmU94c38p7dq1i221tVsdLS1a3q93bKxZlZk5mk9P4vGA+Cxf/r55+/blfC6U1M+PVS1Y8LZ527Y8gPX1dX/88c1Wg2EV308JyeTkfuWsWRHG4uIhVAFBtpjPJyfnTb7hUKWnN2tWrQrDcHxT5m3b8jQrV4ar0tOb+fwe+tSpQLq+vgnla4GkB9Hk5T1rfu+9l/l6WkWEhdGqBQty3XEbqeBhV0FBjnXfvi18vpBVZWSctR' .
        'oME3CIdTcLsmbNqqGtW9/ma6+4Mi2tk5w4MdVYUtKLzf/uJESVtHrx4v2WysoMDMiPwVFYOMf8978f4CP2lSiVQP3oo++a33//CWzyPz83sVRW5vJ18/J57DGo6+NROQhVVBRq3bNnHx9wEGFhtCY3dyGGA0Jukpu7kAgL4yX2tXz44UrtmjWrUPrNyABir6ur5yPOVUye3KN+9NHRptLSj7GJc5eptPRj9aOPjlZMntwDe2yWpoHl44/LqaKiUAzIN+NPAx8l68rZsy8opk8Pw/kGXBlLSnoV06eHKWfPvgB7bKa7m7DX1dWj8ltFz0G0+flPmrZsKYe9j0GM4jhvFF9VDj5Ll+4079ix1KtzEKqoKNSyd+8m2HCos7P/geEQRtaqqmnq7Ox/QM9HPvooW1tQsMyrQyy6oaEW6h5ymQz45OSUirH3wJtl2blzsU9OTimQwauiZ2kaWPbsqRA7HxENEM0vf/my7eDB+6G65ezs7eaKiqexyQovc0XF0z7Z2dth5yN0Q0Ot1wFCrV8faTUYdFDDqqysGvP27Y9hUxURku3bH1NnZdXAHNN28OD9mtzcDV4FCH327D6Yu9pU6enNlt27Z2MTRSDc2r17NuwaLuvevf9N6XTDvQIQbX7+WpjtQBVTplyWJyYmYdNER/LExCTFlCmXoYVaPT2Eo7XV4PGAUHo9aaupeRnaQsTFmRRTp8ai3EDZG2UsLqYVU6fGyuPiTNC8yCefJGrXrl3s0YAwXV3vwmp4JvXzY5Vz5szlay8BFmdIhpRz5syV+vmxcIyHAfTJk2UeC8jNxBzac231okUv3NmNEAs9mTZurFcvWvQCrPHsJ08O06xe/UePBMTR2roN1uE1qvnzTw9t3boBmyD6G' .
        'tq6dYNq/vzTsMaz1dT8zuMAoXS6GFttbQqUvCM21iwfN24mNj03StrHjZspj401wxjL2dGh0Kxc+aJHAeI4f74CRqM3iVrNqtLTF+C8w/3yEVV6+gKJWg0lH7EfP17oMYBQOl2CraZmIpTQKiPjgCec3+2VkLzxxiFVRsYBSOG6WpOb+1uPAMTR1vZ/MHagyaOjrURk5BJsau4rIjJyiTw62gpjLPrEiefcHhBKpxtuP3gQSlWtctasX+PQyv1DLeWsWVA6vdNNTZQ2P3+tWwPCXLmy0WUycc49lGlpnaby8k0oLTal12vcwShRm6epvHyTMi2tE0oucurU824LCKXXk7ajRx/lPEE/P5acOHE+SousXrjwoM1g6BarPuhePLjNYOhWZ2V9itK8yIkT58N4gUg3NATwvWeEN0BcAwNFMPZ6KGfOrEbpDA71woUHLXv2TKebmihbdfUFVCGhdLrhturqC3RTE2XZvXsWSpAYS0palTNnVsMYy9nW9nu3BMRx7hznfRlSrZYlIiJWowbHnXEwipDcCcetv6EGCRERsVqq1XL2Ivb6+jhKr/d3K0AonS6GPnVqFNdxFDNmHBP7IMgfggNVSL4PDhQhMb72Wpdy1qzDnCMVk0nCdHe/5FaAOLu7X+DaNlSiVrPyqKg8lOFADZIfgwNFSIj77/8VjJeHjs8//w/3AqS1dQ7n3GPGjAYUco+fggMVSO4GDtQgMZaUtCpnzGjgnKw3N/tROl2CWwCiLSxMvZtF+lHvQZJAPnbsaneBQ2xI7gUO1CCRjx27WkJy7BfIMIC5cmWDWwDCdHdzniiZnHzZWFLS6E5wiAXJz4EDJUiMJSWNZHIy592HjnPn5rkFIM4vvkjjfFcZM+Zdd4RD' .
        'aEi4wIESJDDWm25poaj16yORBoRavz6SbmnhFF5J/f1d0qCg590VDqEggQEHKpBIg4Kel/r7uziHWX19RUgDwvT1FXHtkqiYNKlRrD3msODgGxKYcKAAibG4mFZMmsQ5pGYuXXoYaUBcvb0zuY5BRES8IsYiUXq9xtnRkQh7XNiQ8AHH7fD44sWJYtVuwVh3uqkpjNLrSWQBcbS2juF4kexiHYt2s8nAGDI+3ogqJHzCQcbHG5Vz5owRq2LaVFZWQURE2DndoG/ckLBmcyaSgFA6XYKzq0vOKVl74IEzIj9R6UUVEkHgEPmYCBjr7xoYyEYSENfAwC85u9mRI/8GRBaKkHgDHLDWn/nqq0lIAsJcvcop/5D6+bESX9/NAAGhBIm3wAEAABJf381cy+AdbW2j0QSku5vTM2h5TMxXKHVIRAESb4LjZh5Iy2NivuJohwTM9yHQAHF2dPhy+bxs1KhTADGJCYm3wQHTDlxG48NIAaItLEzlurVW5u9fBRCUGJB4KxwAACALDPyI6xis0TgNKUBYs5nTAfASkgQSX9/3AaISEhJvhgMAACRa7U6uxYtMf/94pABxGY0TOD29CAuzot6xRCBIxnkzHDfzkCEiLIxTayBXf/8wtDyI0RjOya2OHPkVcAPxDYlp8+ZGb4YDlj0wPT1atDzI4CAnYqUBAeeAm4hPSNihIYm3wwHDHphr12SwSmagAML09d3HaRIUdRa4kfiExNvhgGIPDANYm20yMoC4rl/nlFVJ1OoG4GZCHRJ3hQOWPbBWayISgFB6vYbruR8SheIkcEOhCok7wwHNHmh6BBoexOHgdNa5RKkEqLT28QRI3B0OAL5uCSRRKrl5EJoejgQgrMMRxjHeZICbCxVIPAE' .
        'OWHbB2mzBqHiQUE4T8PX1iBNqxYbEk+CAYRcsTVNIAMIyDKe2jxKVyg48RGJB4mlwAACAxMeH26EyDocPGh6EZTk1qJYoFB51xrnQkHgiHAAAIJHLHUh4Mgg5iB/AEgUST4UDhliaVnmGB1EqLR4MyVSJRsPyMb5Eo2GVc+ZM9VQ4ONuFyyVFAxDuOQzhiQt8syr3KB/lIwB8XZZiq64+ivohPu5uF5wBkRDEDY7JFOmhcPBSlXunUD/ER1S7IEkrEoAAqdSJI17h4fAKSLjcuKVSFyqADHBypTabEsOBIYFuFwRhQwIQiVzOCRDX0JACw4EhgW0XErncjAYgJMmpdp81meQYDgzJdwAZHORmFwrFNTRCLJLs4PJx5vp1KYYDQ/I9gHCyC4lCcQUJQIzFxQOcKi8ZBvB1fJa3weEpkFA6XQLXUwIkCkUXEoAAAIA0IIDTkyzWYpmM4cCQwLQHCUl2IgOILCCAU0cSl8UyHsOBIYFpDxKl8hg6HiQwsI/THcNojMdwfF0+giHhbg9SPz8W1iY8OIBQ1JecEvXe3jHeDgcZH2/U5uUloHw+iVBi+vqiOEU0wcFWWHOBAohEoznP5fPOy5cDvR2Om1W5n6N+iI8QcnZ1cWsjFRjYjxQgUoridLYd7I7cbgpHLwBoH+IjyLVevz6S6e7mVKgo8/fvRAoQiY/PAa79VF2Dg495Oxy35M2QwLADqZ/fSaQAgdFPlentzcBwYEhg2IHE1/efSAECAACyUaO6OV2YS5fiMRwYEq52INVqWdPGjdXoATJ8eD2nBWtpoaiiolAMh/dCQul0w+mWFk7XnBg79hrMOUEDRBoQsIPbrYMBrsHBXAyH90LiMhoLuJaYEKNGnUUSEIlavZ/rAY' .
        'xMV9cSDIf3QgJj/aWBgQYkATEWF9Py6OirXMawnz4dS+n1JIbD+yCh9HrSfvp0LKebtFIJpPfd9w6SgAAAABEZyel9iGtgQOq6fr1QjAVytLQccIfDa/iGxNHSckCU8Or69ULXwAAne5THxV0zFhcPIAuINCjoda5jODs6RMlD5HFxc+VxcSaU4eAbEnlcnEkeFzdXjOsPY92J8HDoJyVDBcS0cWM9ERbGqVMifeJEDKXX+wu9QMaSkl7V3LnRsCCRx8WZ+GzqBhsSeVycSTV3brQYfbYovd6fPnEihus4suDgcqQBAQAAeWxsCydXazJJmO7ul8S4i8GCRChjgwWJmHAAAADT3f0S52PEg4Odpk2bKpEHhBg9ehPnfKCpKVusJylcIRHa2LhCIjYcsNabTE4+xcfcoANiKi9/SxYczGmHId3URGkLCnLcDRKxjO3nQoICHNqCgmUwHo4QoaGlbgEIAACQSUmcz5ijm5r+DETUvUIitrHdKyQowHFznV+CAIfDVFZW4TaAEGFhG7mOYa+rG60tLExFAZKfMjpUjO1uIUFlvtrCwlR7Xd1ozjfkCRPq+JojL4CYysoq5DEx3LpzMwxwtLS8DUTWTxkdKsbmjvN1tLS8zbW0BMhkgAgP/71bAQIAAGRiIucnCvbDh2Opdeumo2p0qMHhTvOl1q2bbj98OJbrOIqkpD7jG28ccjtAZMHBv5ao1Zxqs1iaBnRT0xYUjQ5VONxlvnRT0xaW5n64mDwu7h0+5ynlc4EUDz7YynUc26FDUdqCgmUoGZ1q7txGlOFAfb7agoJltkOHoriOIwsOdkqHDfsDn3OVsCy3TjNdQUE/fCGeeuoRU2npHs7hWny8kW5q8gVYHiEyPn4QxqNd9' .
        'ZIleyy7dmX90P+HXr3Kea689sU1lZZ+rJg8uQeCO6Z8cnLexKbl/vLJyXkTBhxSrZYlRo3K53u+vDeOJsePh+ICbQZDAcqdT7DuIjFfvz7SZjAUwBhLkZZ2UoiQkXdATOXlb5FJSZy3QTL9/VL6zBkDNjP3FX3mjIHp7+d+5IZazcrHjFkpxJwFOXpAMWmSHooXqamJ0qxe/Udsau4nzerVf7TV1ETBGEs5e/YxY0lJq8cAYvrrX9+BkYsAAIClsvIPYr9hx7o3aQsLUy2VlVBCbSG9h2CAAAAAmZSkAzIZ53FcN25I7LW1+ym9XoNNzw3yDr1eY6+t3e+6cQPKcdiqjIwDxldfbfc4QExlZR+oZs9uhhLLNjVRjubmamx+6MvR3FwNayszERrqICIjBW3sIejxZ/L4+CyunU9uybpv3yScjyCed+TmbrDu2zcJ1njKefP+01hcPCTkb+D1ReH3Sb1kyW7Lrl0LodDt58f6rFiRDrOTHha0vGOO+W9/+wRWaKVMS+u0HT4ccS+fQf5F4fe6yYiIbHl0NJTzG1w3bkgslZUG6plnJmKTRCjveOaZiZbKSgMsOCRqNUsmJYnSM01wQIzFxbTyoYdWwUjYAfj66ARLVdURVNqWej0cRUWhlqqqI1yPMPhG1JGZucv4+uunvQKQ2wn7/Pn1sMZztrcrbdXVjWJ0Q8G6Aw693t9WXd3obG9XwhpTHh1tlYWFibb9WrQzyuWxselERIQd1nh0Y6Of/dChZrE6M2I49KT90KFmurHRD1qCTJJA+dBDq4zFxbTXAWIsLh5SzZ//ONeDd+6U/fjxYHtd3Rf4HYngcGjsdXVf2I8fD4Y5rnrRop2msrIPxPxtgj/F+s5FgPhU65bIxMTr' .
        'ypkzY1Hfr+ERcOh0w221tefos2fvgzmuYtq0L+1HjoRxGcMtn2J9W5Zdu7LI5OR+mGPSZ8/eZzUYLlI6XQI2YV7hSLAaDBdhwyELCXEqUlKmofAbpShMQjl9eqosJMQJc0xHa6va8uGHp1DY0+6RcKxbN93y4YenHK2taqghDUkC9cKFq2Cdc+4RgBhffbVdvXBhjkSphDqus6tLbt62rUabn/8kNml40ubnP2netq3G2dUlhz32zbyjApXfKnoOcqd8cnLeNFdUPAX9V8pkQJ2Vtd9SWZmBzZujAS9ebLBWVc2D0XCBj7zD43KQO2WuqHhanZVVA31ghgGWysp5ipSUXrwr8WeGVOvXRypSUnotlZW8wEEmJl5XPPjgA6j9bilqE7Ls3j1bmZbWycfY9pMnh5krKs5r8/PXYpO/p5Bqrbmi4rz95MlhfIwvj4mxKGfNGi90IaJbAgIAAGRqajyZmHidj7GZvj6ZacuWUlVm5hH85v0nvIZe76/KzDxi2rKllOnrk/HxHURoqEOVkTERlaQc6Rzk24tj3bu309HSouXrx8uCg52qjIy/DG3dugHj8E1pnnjiT1aD4bdMTw/B2/UPDHSpH3tsLl/V2DByEGQBAeDrwjfrP//ZCvtR4neSw5SUPsWDD2bz2cLSbbzGunXT7XV1O/kKp26HLlot67NixRI+Dr3xGkAAAIDS6WKsBsNpviGRKJVANXfuISIyMgdVd8/rdS4qCnW2t1dYDxyYztps/IYtajWrycl52lRevonP7/EKQG57kv37m/kMt+68sylmzDgmHzNmpZB7n0UDY/36SMeFC+/aDx6cwvUYtLu6vn5+rM/Spb8ylZe/xfd3eQ0gt3IS2yeftMEua/ixu5xyxow' .
        'G+dixOUK1mBEUDJ0uxnH+fIXt4MEk1mKRCPGdUn9/l8+yZY8LVYDoVYDcgsR+9Ohn9mPHRgn2FEOpBIopUy7Io6JeFuKux7e0+flPOtrbi+xHj8byHUrdKSI01KFatGi+kNujvQ6QW1JlZtZZq6oE741FhIY6yKSkI7LRo58zbdxY7zZQFBamMl9++QLd0DCNj/KQn5I8NtasmjcvWWhP7LWAAACAz/Ll71sqK5fz8Vb3bkQmJNyQx8VVSYOCSlGERVtYmOrq71/jaG7OgrmJ6V6lmDLlsmLq1PHG4uIBob/bqwG5GS6stVRWboTR75WLZCEhTnlMzBeykSMPyAIC3jaWlDSKkFMkMNeurWauXJnraG2Nhrkn/OddFBlQZ2XttVRWZoo1Ba8H5JZh2KqrD8NqTgYlFAsLo4moqHapr+9FqVb7uUStPgMzMdUWFCxjLZYJLpNpnGtw8H5nW1uk89IlZLYaS/39XerFi38ztHnzK2LOAwPy7+Rd4zh37hMx8pJ7BUc2bNgNCUXd7nYv9fX9UkKS31lJlqaDXIODt0+AZY3GAKavzw8lEH4o9FTMmDEfhbATA/ItafLynrXu2fMXvuqGsH7EkEgSqBYs+Jflo4/SUZmTx5W7c9XQ5s2v+PziFxF8VQNj/YBnjIy0aXJzV6AEBzTwPcmDfNub2Kqr/+zs6FBgE+bJeNRqVvXwwx8R4eHLxWzNg0MsDrmJs719l9VgmCvU22JvkWLatC8VycmPiPHEDgMCWdrCwlT69OmdQr6B99hwKiyMVqanPyf2EyoMCB9hV27uBltt7X/BbI3pLZJqtawyPf0AERm5BMWdfxgQmKCsXPmi/fjxQr5L6D0CDD8/VjlzZjUREbHa3bYBYEAgeB' .
        'R7Xd1vhCijdzfJhg1jlDNnVsrCwtaIUSaCAUEJlLy8dfSJE/8jZs0SMmCEhDiVaWnbZaGhBe4SSmFAhErmCwpynB0dz9pPnEhwDQxIvQUKCUkCcsKEHnls7BZpUNDzKD6yxYAgJEqvJ13Xrj3naG3NpRsaRgm5b0JIyePiTGRCwl7ZyJEbPHH3JAZECFiKikKZnp7/FbtsHFoIFRzsVEyadIwID/+9pzepwIAIDYtOF8P09z/tvHgxy9HSEgLrDD5+iZABcvz4a0R4+CnZiBGlptLSj71lvTAg4ucsy5j+/mXMV19NdLa1jeSzh9RdL6hazcrj4q4RISFN0sDA/VKtdqu3npOCAUEwHGNtthmu69fnuYaGolwDA6NcAwP+fLxvkYWEOGXDhw/KAgJ6pAEBZyQazVmJSnXUnbYCY0Cw/u1tCgvnAKdzBGu3R7EWy+0G2qzVGuIaGvrO0WUSkrRIfX3P3f4DQQxKtdp6AABA6XgADAgWlhdLii8BFhYGBAsLA4KFhQHBwsKAYGFhQLCwMCBYWBgQLCwMCBYWBgQLCwsDgoWFAcHCwoBgYWFAsLAwIFhYGBAsLLfS/w8AGnSf56HOIC8AAAAASUVORK5CYII=',
    'success_small' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAADXklEQVR42rSWWUwTQRjH/22HtgilgEatLREUEvXBaDzASglVrLcREhWCGEXThASP+MAzJjwaH/CKFyE+YHxRI3JYoYioWEBUTMAztLWlttoL2tila/Flty5QrcUwyWZnMzu//zfz7fy/5U1MTGA2Gx+z3AjbSdfPnTZYmX5a7gjYqy2UeYs1YJF5aU8cAEhJcnCRUPFVRuTtMPNragsvGxU6aYg716LxAgB47BZNFTggO3ip29N11PzDJPxbhIvFGcE1ouybtdlXKgGMs0J/FDiVUSV8O/' .
        'qmt935cGUsW6FO0gx2VRhUxldmr0In/ckKTMvBTOAA0DGqW5F7ad1TABKLxiuImORiWdnFmcCXirMoHnh4PNa2vEJffh5AAsvmcxPa6dJrY4VvEKusxpP24gLhjhcA8FJgKFZrVcsACCcJOAL2ahtlJTHB41UjLYUdR0yvvnwUiPk0AIxQFpK5L6OKXUVYwBwwbYsZvrfjsM/ptx7rLb3aOtqYy44547/lApAAiAsL2CjrfLYv4AmwVJxF/SP8Wqv7gZI7bg/ZUpkV/BZgDxEA5EPTZzrl2K+co7LECgcAD+0mAEQASESr4AkgMPabTZ2HezYpE/O+cOC2aPApLvE7B1KSHGT7bXTL6iPPSq7bPzncPZUDOTmJG205czbaWwsfH/I5/SPR4MkkhZ7mRTKh3GH6Maxgnx/5m9eWPy9pqlPe2u7c41wVDARTAj4qdKy3tD5K5FjAk7mB1zSAUHgFcpLWPvVFna95ffnzkpax7z464KOs2pdlddHgACD1pPQCoADQYS863Xh8iSH1yXsrZZl2FrYm7HomEPLHm9331dHgclEaPXomeGBI/74fgC0sQAjhnzBoL9/x3tb+j/8X+Hbeqy9qqAFgBOAOb5FCJw3VZl89qU7SDM4Unifa/Lm+qOEcACcA/6QcMG28q8KgypcUDM0Efnd3sxaAA4ALwHjEesBYraRCX35hgPTvNwWG46IVnCzniqb6woZzDNwOYAzAzz9WNEYkQa1VLcvcl1Hljv+u/BqyzXPTLgIAKSSVXsiTuSSe5L7us3033nV+MDFRuwD4uQWHm+RIPwRCxlMkzF3EOTs08yn6mYj9zLZMqs1/E+AKxTEX4Vh8iBEJMlco0uRfAwBp3ZrbANBFLgAAAABJRU5Er' .
        'kJggg==',
    'failure_small' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAADfklEQVR42rRWbUgTcRx+7jwtFs6dK3EdVitJk7YvRYaY9KKUUNCHsheTyrUFKwpBo75F9CGsiKhGGIQVDXoRgzKmUxKcYpgNDWzSi87XTWun5Exvd7e+3OZ0l5TRH/7cwfH/Pb//8/x+z++IYDCI/7lI/OdFhV76ly2L+qgsKWF4r/ei0N+fJwwMaMSxsVgAIFWqAMEwniDDNHwmycvbLJbeHpoWI89qWRYAQIQomgugKCy0cA6HgXe74+bLMGbVqoCQmflQe/fuaQBcCOi3AMqysjiuo6' .
        'Ntqq5O/1dc5+V17Wtt3dLW1zfeQ9NCCCBKg4UEBwDRbs94lpnpABCvZdkYWZEVR47cWUjw0ArW16/rNBhuAVgSik1GCjrd2Gj616pJePv2YOnWrRkA4mYB8F7vRWFggJp7gNDr/V/y85+SycnhKiE1GvFrfn4VuX79ZBRVg4NU4cqV50K3CAMIbveuqHQIAp8Y5mWu1Xr9w8aNF0i1WiTVatGella+w2q96ktNfQ6CiDqmGh3NAqAEEBvOWBgaSoomNYi1HR37XxUVOXc/elTZbDJxoxMT8Ses1ppmozFb3dJyWJBxAtLjSQSgmAUQaqKoKw8Nxeimp6+0GI2BrIqKSgCU02w+lGiz3RBYVt4JWJYCsAgA9cdWMTI5qZQ6f1ytUPyUo0bGJWY0IFWqgGwDMYxQr9OV7338+KXTbD7QV1patOLatQffdu48RTIMLxuapvmoPiCXLx+RE9ml1z81VFdXNxuN2Ym1tTeDL15UtJvNxRsslif+rKx7cjcRkpNZADwAcUaDlJQGAEfnipw+OLjnXXHxRJLDUSz4fCQALH3z5naXyaRXdncXBmRE9tB0G4BpAHzYi5rOnFm9pqmpW64X/sqTUlL4kxx3wOZyvQcwHKZom8XSK2RnV/5rJ/fqdK9sLpcbwA8AgVluqmXZxe6CgnbRbs9YSHBu+/YvaVVVxwH0A/AAmJpbpty+1tYtRG7ux4UE31RTYwIwAsAHgJOdB5LVxncaDLdVTmeB0NMTOy/nWm3AnZ7+OsdqvS4F90r0CL+daBLIkrM5OenHtNrzqu/fN5PDw0ulDgVomuc1Gp83IeHdpfb2+zaXq1fK2gfAHzlwwgAURcn9EMRJrhgvPRdFzHFeKkW/lLFfomXWbJ4PIBIoV' .
        'toxEc0pSjQEpC3KHf41APMohmVPFOQaAAAAAElFTkSuQmCC',
    'exclamation' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAAsTAAALEwEAmpwYAAABNmlDQ1BQaG90b3Nob3AgSUNDIHByb2ZpbGUAAHjarY6xSsNQFEDPi6LiUCsEcXB4kygotupgxqQtRRCs1SHJ1qShSmkSXl7VfoSjWwcXd7/AyVFwUPwC/0Bx6uAQIYODCJ7p3MPlcsGo2HWnYZRhEGvVbjrS9Xw5+8QMUwDQCbPUbrUOAOIkjvjB5ysC4HnTrjsN/sZ8mCoNTIDtbpSFICpA/0KnGsQYMIN+qkHcAaY6addAPAClXu4vQCnI/Q0oKdfzQXwAZs/1fDDmADPIfQUwdXSpAWpJOlJnvVMtq5ZlSbubBJE8HmU6GmRyPw4TlSaqo6MukP8HwGK+2G46cq1qWXvr/DOu58vc3o8QgFh6LFpBOFTn3yqMnd/n4sZ4GQ5vYXpStN0ruNmAheuirVahvAX34y/Axk/96FpPYgAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAUggAARVYAAA6lwAAF2/XWh+QAAAE2ElEQVR42rSVbWhTZxTH//eeJE0Trbnplc6mTbxlziX1hTo2W9HR4ssEP4yNQouFGbU6EQY6rDBhKLLC/LINxtR92NgoYx86JqMFZ3UOX8Y6bO2qbVqxGnPTVGtrbjtXkzb33mcf9iQ2afWbDxzu5Xk5v+flnP8RGGN4kU3EC26W9E908eI5gwUHD3r00dFjhqpuMaLRJWY8bgEAwe1OiaWlD5jH89st4Pim06fVsCSZs9cqmgYAENJXlAtwNDScmrlyZZeuqrZ0n2C3AwBYMpmZRz5fyqiq' .
        '+l45deoDADNp0DMBBU1Ntpne3mvJjo5VAEDl5VOaonTeSCYvX4pEbkEQWI3X+8oKu71aCoerjP5+BwCImzeHajs7N1xT1cmwJBlpABhjYIxBlWWosoyH27f3qrLMol4v6wsGz7udzmoiqiCiZUTkIaIibp5il8s/sHPnuWhpKVNlmUXr60NE5KL/G4goGzB+4MBXqiyzqM9n/r5jx9dEVMkdu1eXlDh7Dh0qu33kyNJdVVVWIrISUT4Ruf/et++LqM/HVFlm/Xv3thBRARGJWYCJ5mZPbNWqlCrLrC8YPM+dK0TkJCJxornZE/P79VggYLQ0NLxKRFZVlsEdOe82NrapssyGV69OfVhT8wYR2YnoaZjqo6PHjJERCwUCiTdbW5sBPALwEMCTsCSZSV0nc3KSzIkJ8c9IxAPAoWiawB818dH16++R358wYzFLUFEOA3ACEDMA4969rQAQLyv7YzKZ/IcDEmFJepqJFgtgsWAikVgAIBNdYUkyf+rtnWR+/zkAkMbG1gNYCMD6FBCLFUEQcCORuATgMXduzpc8jDEhty8sSabhcv0MQYA4MuLmJ7BmEs149Mgi5OXhsqreBvAEQGqOZ11/btbOEHXb8/LAE9LOz5zTBIEB0AHk7t4UXS6TMQaDMWM+gMNqNWctoqw3EAsLdTY9jWqvd9l8i88NDd1vXb785QN5eet/HRy8C2Amd47NMCrY9DREt1ufI3ZUUvIQjGGl3V7DNSpLCN9esYKt8XgS6xXlgeRwjPDoypbiePwdMAazuDgOwABgZpyYpaUXAEC6c2edUljoAmDNuf8lZR0dsdq+vqFPtm4tApD10AVNTTb95s1tADAmy50AkgD0DGBIEI5TcbFuDAzkt23b9hmP88x' .
        '4UtcFMAYIgnA1HH4JQL6iaRmIHon8kBocdFBJiX68q+tbAFMAUhkHNSdP3tM3bPgOABZcvLile8+ej7kTMf0GlysrV35aVLTpx56esdm7dwaDRxPt7bUAMFxRcaYtFBrmoZ7K0iIisg/X14fSYne3sbGtbs0aiYhEPm4jokXcbBMnTtjG9+9vTYtduK5ukIjWEdHStFRkybWiaeLrXq+rde3aq+zCBT8AWAKBKeb3n9cLCs48EcXufKvVdJpmBdO0d43+/rdSodACADA2brz1Wnv7+5PJ5AMA9wH8C8CcUw8UTSMAC2/u3v3lou7uOiMSsT634ChKari8/Jd1LS2fc3kZ5ddjPLOicYjzUHV1oMHnO+waH6+kWEw243ELBAGi260bHs/4mCT9dbSr65uzAwMjAOLcpmYXnAzAMjepRS5oTi5cTp7+lA4cANM8Wh7z70yuAjwPMBtk5TY7AU0OSXGbVxj/GwAgnTOloYlpygAAAABJRU5ErkJggg==',
);


if (isset($_GET['checkConfig'])) {
    $ret = (checkOSPath($_POST['API_OC_ABS_PATH'])) ? '1:' : '0:';
    $ret .= (checkAPIPath($_POST['API_ABS_PATH'])) ? '1' : '0';
    header('Content-Type: text/plain', true, 200);
    echo $ret;
    exit;
}

if (isset($_GET['checkDb'])) {
    $db = getDB($_POST['API_DB_DRIVER'],
        $_POST['API_DB_HOSTNAME'],
        $_POST['API_DB_USERNAME'],
        $_POST['API_DB_PASSWORD'],
        $_POST['API_DB_DATABASE'],
        $_POST['API_DB_PORT'],
        $_POST['API_DB_PREFIX']);
    $ret = ($db && $db->ping()) ? '1' : '0';
    header('Content-Type: text/plain', true, 200);
    echo $ret;
    exit;
}

if (!(isset($_GET['step'])
    && (
        ((int)$_GET['step'] == 1 && empty($_POST['step']))
        || ((int)$_GET['step'] == 2 && (int)$_POST['step'] == 1)
        || ((int)$_GET['step'] == 3 && (int)$_POST['step'] == 2)
        || ((int)$_GET['step'] == 4 && (int)$_POST['step'] == 3)
        || ((int)$_GET['step'] == 5 && (int)$_POST['step'] == 4)
    ))) {
    $scheme = (empty($_SERVER['HTTPS'])) ? 'http' : 'https';
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    header("Location: {$scheme}://{$host}{$uri}/install.php?step=1", true, 301);
    exit;
}

if ((int)$_GET['step'] == 2) {
    if (checkVersion() && INSTALLER_CONFIG_ABS_FILE) {
        include INSTALLER_CONFIG_ABS_FILE;
    } else {
        header('Content-Type: text/plain; charset=utf-8', true, 200);
        echo 'Отсутствуют необходимые файлы. Продолжение установки невозможно.';
        exit;
    }
}

$CONFIG = '';
$DB_DRIVER   = '';
$DB_HOSTNAME = '';
$DB_USERNAME = '';
$DB_PASSWORD = '';
$DB_DATABASE = '';
$DB_PORT     = '';
$DB_PREFIX   = '';
$API_DB_DRIVER   = '';
$API_DB_HOSTNAME = '';
$API_DB_USERNAME = '';
$API_DB_PASSWORD = '';
$API_DB_DATABASE = '';
$API_DB_PORT     = '';
$API_DB_PREFIX   = '';
$API_SESSION_TABLE = '';
$API_DEVICE_TABLE  = '';
$config_write_success          = 0;
$session_table_created_success = 0;
$device_table_created_success  = 0;
$devices_write_success         = 0;
if (isset($_POST['step'])) {
    if ((int)$_POST['step'] == 1) {
        
    } elseif ((int)$_POST['step'] == 2) {

        $config = <<<'CONFIG'
<?php
namespace OpenCartWebAPI;
include "./config/statuscode.php";
include "./config/actions.php";

/**
 * Версия API.
 */
define('API_API_VERSION', 'v1.0');

$time_arr = explode(' ', microtime());
$start_time = floatval($time_arr[1]) + floatval($time_arr[0]);
/**
 * Время начала обработки запроса.
 */
define('API_REQUEST_START_TIME', $start_time);

CONFIG;
        $_POST['API_TEMP_DIR_NAME']            = strtolower($_POST['API_TEMP_DIR_NAME']);
        $_POST['API_SESSION_TABLE']            = strtolower($_POST['API_SESSION_TABLE']);
        $_POST['API_DEVICE_TABLE']             = strtolower($_POST['API_DEVICE_TABLE']);
        $_POST['API_OC_ABS_PATH']              = rtrim($_POST['API_OC_ABS_PATH'], "/\\") . '/';
        $_POST['API_ABS_PATH']                 = rtrim($_POST['API_ABS_PATH'], "/\\") . '/';
        $_POST['API_BASE64_ENCODE']            = (isset($_POST['API_BASE64_ENCODE']))            ? 'true' : 'false';
        $_POST['API_DEBUG_MODE']               = (isset($_POST['API_DEBUG_MODE']))               ? 'true' : 'false';
        $_POST['API_FULL_URL']                 = (isset($_POST['API_FULL_URL']))                 ? 'true' : 'false';
        $_POST['API_CHECK_DEVICE_ID']          = (isset($_POST['API_CHECK_DEVICE_ID']))          ? 'true' : 'false';
        $_POST['API_AUTOGENERATE_URL_ALIAS']   = (isset($_POST['API_AUTOGENERATE_URL_ALIAS']))   ? 'true' : 'false';
        $_POST['API_AUTOGENERATE_PRODUCT_SKU'] = (isset($_POST['API_AUTOGENERATE_PRODUCT_SKU'])) ? 'true' : 'false';
        $config .= <<<CONFIG
/**
 * Абсолютный путь до корня OpenCart.
 */
define('API_OC_ABS_PATH', '{$_POST['API_OC_ABS_PATH']}');

/**
 * Абсолютный путь до корня API.
 */
define('API_ABS_PATH', '{$_POST['API_ABS_PATH']}');

if (defined('API_OC_ABS_PATH')) {
    \$oc_config = API_OC_ABS_PATH . 'config.php';
    if (file_exists(\$oc_config)) include \$oc_config;
}

/**
 * Кодировать ответ (по основанию 64/BASE64).
 * Кодировать ответ в Base64 для сжатия данных.
 */
define('API_BASE64_ENCODE', {$_POST['API_BASE64_ENCODE']});

/**
 * Включает/выключает режим отладки.
 * В режиме отладки будет доступна некоторая отладочная информация, которая 
 * поможет правильно настроить и оптимизировать API.
 */
define('API_DEBUG_MODE', {$_POST['API_DEBUG_MODE']});

/**
 * Указывать полные URL для изображений и файлов.
 * Дополнять, хранимые в базе данных, адреса изображений и файлов адресом магазина.
 */
define('API_FULL_URL', {$_POST['API_FULL_URL']});

/**
 * Необходимо ли проверять идентификатор устройства при авторизации и предоставлять 
 * доступ к API только разрешенным устройствам.
 */
define('API_CHECK_DEVICE_ID', {$_POST['API_CHECK_DEVICE_ID']});

/**
 * Максимальный размер, возвращаемой с ответом, коллекции.
 * Используется в случае, если в запросе не задан параметр «count».
 */
define('API_COLLECTION_MAX_SIZE', {$_POST['API_COLLECTION_MAX_SIZE']});

/**
 * Имя временного каталога.
 */
define('API_TEMP_DIR_NAME', '{$_POST['API_TEMP_DIR_NAME']}');

/**
 * Имя таблицы базы данных для хранения сессий пользователей.
 * Будет создана таблица в базе данных OpenCart, в которой будет храниться история 
 * активности пользователей API.
 */
define('API_SESSION_TABLE', '{$_POST['API_SESSION_TABLE']}');

/**
 * Максимальное количество записей в таблице сессий пользователей.
 */
define('API_SESSION_TABLE_ROWS_LIMIT', {$_POST['API_SESSION_TABLE_ROWS_LIMIT']});

/**
 * Имя таблицы базы данных для хранения правил доступа устройств.
 * Будет создана таблица в базе данных OpenCart, в которой будут храниться правила 
 * доступа доверенных устройств.
 */
define('API_DEVICE_TABLE', '{$_POST['API_DEVICE_TABLE']}');

/**
 * Время неактивности пользователя.
 * Количество секунд до истечения токена сессии.
 */
define('API_SESSION_LIFETIME', {$_POST['API_SESSION_LIFETIME']});

/**
 * Автоматически генерировать альяс URL для SEO.
 */
define('API_AUTOGENERATE_URL_ALIAS', {$_POST['API_AUTOGENERATE_URL_ALIAS']});

/**
 * Автоматически генерировать артикул (складской номер) товара.
 */
define('API_AUTOGENERATE_PRODUCT_SKU', {$_POST['API_AUTOGENERATE_PRODUCT_SKU']});


CONFIG;
        $CONFIG = base64_encode($config);

        include $_POST['API_OC_ABS_PATH'] . 'config.php';

        $DB_DRIVER   = defined('DB_DRIVER')   ? DB_DRIVER   : '';
        $DB_HOSTNAME = defined('DB_HOSTNAME') ? DB_HOSTNAME : '';
        $DB_USERNAME = defined('DB_USERNAME') ? DB_USERNAME : '';
        $DB_PASSWORD = defined('DB_PASSWORD') ? DB_PASSWORD : '';
        $DB_DATABASE = defined('DB_DATABASE') ? DB_DATABASE : '';
        $DB_PORT     = defined('DB_PORT')     ? DB_PORT     : '';
        $DB_PREFIX   = defined('DB_PREFIX')   ? DB_PREFIX   : '';
        $API_SESSION_TABLE = $_POST['API_SESSION_TABLE'];
        $API_DEVICE_TABLE  = $_POST['API_DEVICE_TABLE'];

    } elseif ((int)$_POST['step'] == 3) {

        $config = base64_decode($_POST['CONFIG']);
        $config .= <<<CONFIG
define('API_DB_DRIVER', '{$_POST['API_DB_DRIVER']}');
define('API_DB_HOSTNAME', '{$_POST['API_DB_HOSTNAME']}');
define('API_DB_USERNAME', '{$_POST['API_DB_USERNAME']}');
define('API_DB_PASSWORD', '{$_POST['API_DB_PASSWORD']}');
define('API_DB_DATABASE', '{$_POST['API_DB_DATABASE']}');
define('API_DB_PORT', '{$_POST['API_DB_PORT']}');
define('API_DB_PREFIX', '{$_POST['API_DB_PREFIX']}');
CONFIG;

        $cfg_file = INSTALLER_CONFIG_ABS_FILE;
        $config_write_success = file_put_contents($cfg_file, $config);

        $db = getDB($_POST['API_DB_DRIVER'],
            $_POST['API_DB_HOSTNAME'],
            $_POST['API_DB_USERNAME'],
            $_POST['API_DB_PASSWORD'],
            $_POST['API_DB_DATABASE'],
            $_POST['API_DB_PORT'],
            $_POST['API_DB_PREFIX']);
        if ($db->ping()) {
            $session_table_created_success = (bool)$db->query("CREATE TABLE IF NOT EXISTS `" . $_POST['API_DB_PREFIX'] . $_POST['API_SESSION_TABLE'] . "` (_id INT PRIMARY KEY AUTO_INCREMENT, user VARCHAR(127) NOT NULL, token VARCHAR(32) NOT NULL UNIQUE, createdtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP, modifiedtime DATETIME);");
            $device_table_created_success = (bool)$db->query("CREATE TABLE IF NOT EXISTS `" . $_POST['API_DB_PREFIX'] . $_POST['API_DEVICE_TABLE'] . "` (_id INT PRIMARY KEY AUTO_INCREMENT, device_id VARCHAR(255) NOT NULL UNIQUE, description TEXT, status TINYINT(1) NULL DEFAULT '0', createdtime TIMESTAMP DEFAULT CURRENT_TIMESTAMP);");
            if (!$db->commit()) {
                $session_table_created_success = 0;
                $device_table_created_success = 0;
            }
        }

    } elseif ((int)$_POST['step'] == 4) {

        include INSTALLER_CONFIG_ABS_FILE;

        $db = getDB(API_DB_DRIVER, API_DB_HOSTNAME, API_DB_USERNAME, API_DB_PASSWORD, API_DB_DATABASE, API_DB_PORT, API_DB_PREFIX);
        if ($db->ping()) {
            $db->query('TRUNCATE `' . API_DB_PREFIX . API_DEVICE_TABLE . '`');
            if (isset($_POST['devices'])) {
                foreach ($_POST['devices'] as $device) {
                    if (!empty($device['device_id'])) {
                        $status = (isset($device['status'])) ? 1 : 0;
                        $db->query("INSERT INTO `" . API_DB_PREFIX . API_DEVICE_TABLE . "` SET `device_id` = '{$device['device_id']}', `description` = '{$device['description']}', `status` = '{$status}';");
                    }
                }
            }
            if ($db->commit()) {
                $devices_write_success = 1;
            }
        }
    }
}

// =========================================================================
// PAGE OUTPUT
// =========================================================================

$steps_count = INSTALLER_STEPS_COUNT;
$step = (int)$_GET['step'];
$step_next = $step + 1;
$output = <<<HTML
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta content="text/html" charset="UTF-8">
    <title>Добро пожаловать в установщик OpenCart Web API</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,500&subset=latin,cyrillic" type="text/css" media="all">
    <style>
        *{box-sizing:border-box}body{margin:0;padding:0;width:100%;font-family:Roboto,Helvetica,Arial,sans-serif;font-size:13px;font-weight:400;color:#333;background-image:linear-gradient(to bottom right,#eee,#eee)}.right{text-align:right}.container{display:flex;margin:5% auto;padding:0;width:70%;min-width:650px;max-width:900px;background:#fbfbfb;border-radius:3px;-webkit-box-shadow:0 2px 3px 1px rgba(0,0,0,.3);-moz-box-shadow:0 2px 3px 1px rgba(0,0,0,.3);box-shadow:0 2px 3px 1px rgba(0,0,0,.3)}.container>div{display:inline-block}.container .left-side{display:none!important;padding:50px 20px;width:25%;height:100%;min-height:100%;background:#0000C0}.container .right-side{padding:15px;width:100%}.container .header{padding:10px;width:100%;font-size:1.7em;font-weight:500;color:#777;font-style:italic;border-bottom:1px solid #777}.container .content{width:100%;padding:10px 0 0}.container .content .complete{margin:50px 0}.container .content .complete>div{font-weight:700;text-align:center}.container .content .complete>div:first-child{margin-left:-200px}.container .content .complete>div:nth-child(2){font-size:72px;margin-top:-120px;margin-left:80px;text-shadow:10px 15px 20px rgba(0,0,0,.25);letter-spacing:5px}.container .content .complete>div:nth-child(3){font-style:italic;color:#777;margin-top:-5px;margin-left:60px;text-shadow:6px 9px 10px rgba(0,0,0,.3);letter-spacing:2px}.container .content .complete-failure{margin:50px 0}.container .content .complete-failure>div{font-weight:700;text-align:center}.container .content .complete-failure>div:nth-child(2){font-size:72px;margin-top:-120px;text-shadow:10px 15px 20px rgba(0,0,0,.25);opacity:.8;letter-spacing:5px}.container .content .complete-failure>div:nth-child(3){font-style:italic;color:#777;margin-top:25px;letter-spacing:2px}.container .content .complete-alert{margin:40px 0 60px;font-style:italic}.container .content .complete-alert>div{text-align:center}.container .content .complete-alert>div img{margin:0 5px -6px 0}.container .content .complete-points{text-align:center;font-family:"Courier New",monospace;margin-bottom:40px}.container .content .complete-points img{margin-bottom:-5px}.form .form-table{border-spacing:0 12px;width:100%}.form .form-table tr{padding:5px 0}.form .form-table tr>td:first-child{width:40%;text-align:right}.form .form-table tr>td:first-child label>span{display:block}.form .form-table tr>td:first-child label>span:first-child{font-size:1.2em}.form .form-table tr>td:first-child label>span:last-child{color:#777}.form .form-table tr>td:last-child{padding:5px 20px;width:60%}.form .form-table.one-col tr>td{padding:0;width:auto}.form .form-table.form-table-devices{margin:15px 0;border:1px solid #ccc;border-radius:3px;border-spacing:0}.form .form-table.form-table-devices thead{line-height:40px}.form .form-table.form-table-devices tbody>tr{background-color:#eee}.form .form-table.form-table-devices tbody>tr:hover{background-color:#e9e9e9}.form .form-table.form-table-devices tbody>tr>td{text-align:center;padding:5px 10px}.form .form-table.form-table-devices tr>td:first-child{width:50%}.form .form-table.form-table-devices tr>td:nth-child(2){width:50%}.form .form-table.form-table-devices tr>td:nth-child(3){width:auto}.form .form-table.form-table-devices tr>td:last-child{width:auto}.form .line{margin:10px 0;width:100%}.form input[type=text],.form input[type=number],.form input[type=email],.form input[type=password],.form select,.form textarea{display:block;width:100%;padding:10px 16px;border:1px solid #ccc;border-radius:3px}.form input[type=number]{width:50%}.form textarea{resize:vertical}.form select{padding:10px 12px}.form .form-buttons{width:98%;text-align:right}.form .default-button{position:relative;display:inline-block;margin:15px 0;padding:12px 8%;font-size:1em;color:#fff;text-transform:uppercase;text-align:center;text-decoration:none;border-style:none;border-radius:4px;background-color:#ff3100;outline:0;cursor:pointer;-webkit-box-shadow:0 2px 3px 0 rgba(0,0,0,.2);-moz-box-shadow:0 2px 3px 0 rgba(0,0,0,.2);box-shadow:0 2px 3px 0 rgba(0,0,0,.2)}.form .default-button:active{-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}.form .default-button:hover{background-color:#f02e00}.form .default-button:disabled{background-color:#777;cursor:default;-webkit-box-shadow:none;-moz-box-shadow:none;box-shadow:none}.form .add-button{margin:10px 0;padding:8px 20px;font-size:.8em;background-color:#4f83c5;border-radius:3px}.form .add-button:hover{background-color:#437bc1}.form .error{font-size:.9em;color:red}.form .error-header{display:block;margin:5px 0;font-size:1em;font-weight:700;text-align:center}.terms{padding:10px;height:350px;font-family:Verdana,Arial,sans-serif;font-size:13px;text-align:left;border:1px solid #ccc;overflow-y:scroll;-webkit-box-shadow:inset 1px 1px 1px 0 rgba(0,0,0,.2);-moz-box-shadow:inset 1px 1px 1px 0 rgba(0,0,0,.2);box-shadow:inset 1px 1px 1px 0 rgba(0,0,0,.2)}.terms pre{border:1px solid #ccc;border-radius:3px;background-color:#eee;padding:8px}.terms ul li:first-letter{margin-left:-20px}.terms ul li{list-style:none;margin-bottom:10px}
    </style>
</head>
<body>
<div class="container">
    <div class="left-side"></div>
    <div class="right-side">
        <div class="header"><span>Шаг {$step} из {$steps_count}: {$TITLES[$step]}</span></div>
        <div id="content" class="content">
            <form id="installer_form" class="form" action="./install.php?step={$step_next}" method="POST" enctype="application/x-www-form-urlencoded">
HTML;

if ((int)$_GET['step'] == 1) {

    $license = 'PGgzPtCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QsNGPINC+0LHRidC10YHRgtCy0LXQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPIEdOVTwvaDM+DQo8ZGl2PtCS0LXRgNGB0LjRjyAzLCAyOSDQuNGO0L3RjyAyMDA3PC9kaXY+DQo8cD5Db3B5cmlnaHQgwqkgMjAwNyBGcmVlIFNvZnR3YXJlIEZvdW5kYXRpb24sIEluYy4gJmx0OzxhIGhyZWY9Imh0dHA6Ly9mc2Yub3JnLyIgdGFyZ2V0PSJfYmxhbmsiPmh0dHA6Ly9mc2Yub3JnLzwvYT4mZ3Q7PGJyPg0K0JrQsNC20LTRi9C5INC40LzQtdC10YIg0L/RgNCw0LLQviDQutC+0L/QuNGA0L7QstCw0YLRjCDQuCDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90Y/RgtGMINC00L7RgdC70L7QstC90YvQtSDQutC+0L/QuNC4DQrRjdGC0L7Qs9C+INC00L7QutGD0LzQtdC90YLQsCwg0L3QviDQuNC30LzQtdC90LXQvdC40LUg0LXQs9C+INC30LDQv9GA0LXRidC10L3Qvi48L3A+DQo8aDM+0J/RgNC10LDQvNCx0YPQu9CwPC9oMz4NCjxwPtCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QsNGPINC+0LHRidC10YHRgtCy0LXQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPIEdOVSDRj9Cy0LvRj9C10YLRgdGPINGB0LLQvtCx0L7QtNC90L7QuSwNCtGB0L7QtNC10YDQttCw0YnQtdC5INC60L7QvdGG0LXQv9GG0LjRjiDQsNCy0YLQvtGA0YHQutC+' .
        '0LPQviDQu9C10LLQsCwg0LvQuNGG0LXQvdC30LjQtdC5INC00LvRjyDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4NCtC+0LHQtdGB0L/QtdGH0LXQvdC40Y8g0Lgg0LTRgNGD0LPQuNGFINCy0LjQtNC+0LIg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC5LjwvcD4NCjxwPtCb0LjRhtC10L3Qt9C40Lgg0LTQu9GPINCx0L7Qu9GM0YjQuNC90YHRgtCy0LAg0L/RgNC+0LPRgNCw0LzQvNC90L7Qs9C+INC+0LHQtdGB0L/QtdGH0LXQvdC40Y8g0Lgg0LTRgNGD0LPQuNGFDQrQv9GA0L7QuNC30LLQtdC00LXQvdC40Lkg0YHQvtC30LTQsNC90Ysg0YEg0YbQtdC70YzRjiDQvtCz0YDQsNC90LjRh9C10L3QuNGPINCy0LDRiNC10Lkg0YHQstC+0LHQvtC00Ysg0LTQtdC70LjRgtGM0YHRjyDQuA0K0LjQt9C80LXQvdGP0YLRjCDQuNGFLiDQkiDQvtGC0LvQuNGH0LjQtSDQvtGCINGC0LDQutC40YUg0LvQuNGG0LXQvdC30LjQuSwg0KPQvdC40LLQtdGA0YHQsNC70YzQvdCw0Y8NCtC+0LHRidC10YHRgtCy0LXQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPIEdOVSDQv9GA0LXQtNC90LDQt9C90LDRh9C10L3QsCDQs9Cw0YDQsNC90YLQuNGA0L7QstCw0YLRjCDQstCw0Lwg0YHQstC+0LHQvtC00YMNCtC00LXQu9C40YLRjNGB0Y8g0Lgg0LjQt9C80LXQvdGP0YLRjCDQu9GO0LHRi9C1INCy0LX' .
        'RgNGB0LjQuCDQv9GA0L7Qs9GA0LDQvNC8LCDQtNCw0LLQsNGPINGD0LLQtdGA0LXQvdC90L7RgdGC0YwsINGH0YLQvg0K0Y3RgtC+INC/0YDQvtCz0YDQsNC80LzQvdC+0LUg0L7QsdC10YHQv9C10YfQtdC90LjQtSDQvtGB0YLQsNC90LXRgtGB0Y8g0YHQstC+0LHQvtC00L3Ri9C8INC00LvRjyDQstGB0LXRhSDQtdCz0L4NCtC/0L7Qu9GM0LfQvtCy0LDRgtC10LvQtdC5LiDQnNGLLCDQpNC+0L3QtCDRgdCy0L7QsdC+0LTQvdC+0LPQviDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4g0L7QsdC10YHQv9C10YfQtdC90LjRjywNCtC40YHQv9C+0LvRjNC30YPQtdC8INCj0L3QuNCy0LXRgNGB0LDQu9GM0L3Rg9GOINC+0LHRidC10YHRgtCy0LXQvdC90YPRjiDQu9C40YbQtdC90LfQuNGOIEdOVSDQtNC70Y8NCtCx0L7Qu9GM0YjQuNC90YHRgtCy0LAg0L3QsNGI0LXQs9C+INC/0YDQvtCz0YDQsNC80LzQvdC+0LPQviDQvtCx0LXRgdC/0LXRh9C10L3QuNGPOyDRjdGC0LAg0LvQuNGG0LXQvdC30LjRjyDRgtCw0LrQttC1DQrQvtGC0L3QvtGB0LjRgtGB0Y8g0Log0LvRjtCx0YvQvCDQtNGA0YPQs9C40Lwg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGP0LwsINCy0YvQv9GD0YHQutCw0LXQvNGL0Lwg0LDQstGC0L7RgNCw0LzQuCDRgSDQtdC1DQrQuNGB0L/QvtC70YzQt9C+0LLQsN' .
        'C90LjQtdC8LiDQktGLINGC0L7QttC1INC80L7QttC10YLQtSDQv9GA0LjQvNC10L3Rj9GC0Ywg0Y3RgtGDINC70LjRhtC10L3Qt9C40Y4g0LTQu9GPINGB0LLQvtC40YUNCtC/0YDQvtCz0YDQsNC80LwuPC9wPg0KPHA+0JrQvtCz0LTQsCDQvNGLINCz0L7QstC+0YDQuNC8INC+INGB0LLQvtCx0L7QtNC90L7QvCDQv9GA0L7Qs9GA0LDQvNC80L3QvtC8INC+0LHQtdGB0L/QtdGH0LXQvdC40LgsINC80YsNCtC/0L7QtNGA0LDQt9GD0LzQtdCy0LDQtdC8INGB0LLQvtCx0L7QtNGDLCDQsCDQvdC1INGG0LXQvdGDLiDQndCw0YjQsCDQo9C90LjQstC10YDRgdCw0LvRjNC90LDRjyDQvtCx0YnQtdGB0YLQstC10L3QvdCw0Y8NCtC70LjRhtC10L3Qt9C40Y8g0YHQvtC30LTQsNC90LAsINGH0YLQvtCx0Ysg0LLRiyDQsdGL0LvQuCDRg9Cy0LXRgNC10L3Riywg0YfRgtC+INGDINCy0LDRgSDQtdGB0YLRjCDRgdCy0L7QsdC+0LTQsA0K0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdGP0YLRjCDQutC+0L/QuNC4INGB0LLQvtCx0L7QtNC90L7Qs9C+INC/0YDQvtCz0YDQsNC80LzQvdC+0LPQviDQvtCx0LXRgdC/0LXRh9C10L3QuNGPICjQstC30LjQvNCw0Y8NCtC30LAg0Y3RgtC+INC/0LvQsNGC0YMsINC/0L4g0LLQsNGI0LXQvNGDINC20LXQu9Cw0L3QuNGOKSwg0YfRgtC+0LHRiyDQs' .
        'tGLINC80L7Qs9C70Lgg0L/QvtC70YPRh9Cw0YLRjA0K0LjRgdGF0L7QtNC90YvQuSDQutC+0LQg0LjQu9C4INC/0L7Qu9GD0YfQsNC70Lgg0LXQs9C+LCDQtdGB0LvQuCDRhdC+0YLQuNGC0LUsINGH0YLQvtCx0Ysg0LLRiyDQvNC+0LPQu9C4DQrQuNC30LzQtdC90Y/RgtGMINC/0YDQvtCz0YDQsNC80LzQvdC+0LUg0L7QsdC10YHQv9C10YfQtdC90LjQtSDQuNC70Lgg0LjRgdC/0L7Qu9GM0LfQvtCy0LDRgtGMINC10LPQviDRh9Cw0YHRgtC4INCyDQrQvdC+0LLRi9GFINGB0LLQvtCx0L7QtNC90YvRhSDQv9GA0L7Qs9GA0LDQvNC80LDRhSwg0Lgg0YfRgtC+0LHRiyDQstGLINC30L3QsNC70LgsINGH0YLQviDQstGLINC80L7QttC10YLQtQ0K0LTQtdC70LDRgtGMINCy0YHQtSDRjdGC0Lgg0LLQtdGJ0LguPC9wPg0KPHA+0KfRgtC+0LHRiyDQt9Cw0YnQuNGC0LjRgtGMINCy0LDRiNC4INC/0YDQsNCy0LAsINC90LDQvCDQvdC10L7QsdGF0L7QtNC40LzQviDQvtCz0YDQsNC90LjRh9C40LLQsNGC0Ywg0LTRgNGD0LPQuNGFDQrQsiDQstC+0LfQvNC+0LbQvdC+0YHRgtC4INC+0YLQutCw0LfQsNGC0Ywg0LLQsNC8INCyINCy0LDRiNC40YUg0L/RgNCw0LLQsNGFINC40LvQuCDQv9GA0L7RgdC40YLRjCDQstCw0YENCtC+0YLQutCw0LfQsNGC0YzRgdGPINC+0YIg0L3QuNGF' .
        'LiDQodC70LXQtNC+0LLQsNGC0LXQu9GM0L3Qviwg0YMg0LLQsNGBINC10YHRgtGMINC+0LHRj9C30LDQvdC90L7RgdGC0LgsINC10YHQu9C4INCy0YsNCtGA0LDRgdC/0YDQvtGB0YLRgNCw0L3Rj9C10YLQtSDQutC+0L/QuNC4INGB0LLQvtCx0L7QtNC90L7Qs9C+INC/0YDQvtCz0YDQsNC80LzQvdC+0LPQviDQvtCx0LXRgdC/0LXRh9C10L3QuNGPLCDQuNC70LgNCtC10YHQu9C4INCy0Ysg0LzQvtC00LjRhNC40YbQuNGA0YPQtdGC0LUg0LXQs9C+OiDQvtCx0Y/Qt9Cw0L3QvdC+0YHRgtGMINGD0LLQsNC20LDRgtGMINGB0LLQvtCx0L7QtNGDDQrQtNGA0YPQs9C40YUuPC9wPg0KPHA+0J3QsNC/0YDQuNC80LXRgCwg0LXRgdC70Lgg0LLRiyDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90Y/QtdGC0LUg0LrQvtC/0LjQuCDRgtCw0LrQvtC5INC/0YDQvtCz0YDQsNC80LzRiw0K0LHQtdGB0L/Qu9Cw0YLQvdC+INC40LvQuCDQt9CwINC00LXQvdGM0LPQuCwg0LLRiyDQtNC+0LvQttC90Ysg0L/QtdGA0LXQtNCw0YLRjCDQv9C+0LvRg9GH0LDRgtC10LvRj9C8INGC0LUg0LbQtQ0K0YHQstC+0LHQvtC00YssINC60L7RgtC+0YDRi9C1INC/0L7Qu9GD0YfQuNC70Lgg0LLRiy4g0JLRiyDQtNC+0LvQttC90Ysg0YPQsdC10LTQuNGC0YzRgdGPLCDRh9GC0L4g0L7QvdC4INGC0L7QttC' .
        '1DQrQv9C+0LvRg9GH0LDRgiDQuNC70Lgg0YHQvNC+0LPRg9GCINC/0L7Qu9GD0YfQuNGC0Ywg0LjRgdGF0L7QtNC90YvQuSDQutC+0LQuINCYINCy0Ysg0LTQvtC70LbQvdGLINC/0L7QutCw0LfQsNGC0Ywg0LjQvA0K0Y3RgtC4INGD0YHQu9C+0LLQuNGPLCDRh9GC0L7QsdGLINC+0L3QuCDQt9C90LDQu9C4INGB0LLQvtC4INC/0YDQsNCy0LAuPC9wPg0KPHA+0KDQsNC30YDQsNCx0L7RgtGH0LjQutC4LCDQuNGB0L/QvtC70YzQt9GD0Y7RidC40LUg0KPQvdC40LLQtdGA0YHQsNC70YzQvdGD0Y4g0L7QsdGJ0LXRgdGC0LLQtdC90L3Rg9GOINC70LjRhtC10L3Qt9C40Y4NCkdOVSwg0LfQsNGJ0LjRidCw0Y7RgiDQstCw0YjQuCDQv9GA0LDQstCwINGBINC/0L7QvNC+0YnRjNGOINC00LLRg9GFINGI0LDQs9C+0LI6PGJyPg0KKDEpINC30LDRj9Cy0LvRj9GO0YIg0LDQstGC0L7RgNGB0LrQuNC1INC/0YDQsNCy0LAg0L3QsCDQv9GA0L7Qs9GA0LDQvNC80L3QvtC1INC+0LHQtdGB0L/QtdGH0LXQvdC40LUsINC4ICgyKQ0K0L/RgNC10LTQu9Cw0LPQsNGO0YIg0LLQsNC8INGN0YLRgyDQu9C40YbQtdC90LfQuNGOLCDQtNCw0Y7RidGD0Y4g0LLQsNC8INC70LXQs9Cw0LvRjNC90YPRjiDQstC+0LfQvNC+0LbQvdC+0YHRgtGMDQrQutC+0L/QuNGA0L7QstCw0YLRjCwg0YDQsN' .
        'GB0L/RgNC+0YHRgtGA0LDQvdGP0YLRjCDQuC/QuNC70Lgg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0YLRjCDQtdCz0L4uPC9wPg0KPHA+0JTQu9GPINC30LDRidC40YLRiyDQsNCy0YLQvtGA0L7QsiDQuCDRgNCw0LfRgNCw0LHQvtGC0YfQuNC60L7QsiDQo9C90LjQstC10YDRgdCw0LvRjNC90LDRjyDQvtCx0YnQtdGB0YLQstC10L3QvdCw0Y8NCtC70LjRhtC10L3Qt9C40Y8g0YfQtdGC0LrQviDQvtCx0YrRj9GB0L3Rj9C10YIsINGH0YLQviDQvdC10YIg0L3QuNC60LDQutC40YUg0LPQsNGA0LDQvdGC0LjQuSDQtNC70Y8g0LjRhQ0K0YHQstC+0LHQvtC00L3QvtCz0L4g0L/RgNC+0LPRgNCw0LzQvNC90L7Qs9C+INC+0LHQtdGB0L/QtdGH0LXQvdC40Y8uINCU0LvRjyDRg9C00L7QsdGB0YLQstCwINC/0L7Qu9GM0LfQvtCy0LDRgtC10LvQtdC5INC4DQrQsNCy0YLQvtGA0L7QsiDQo9C90LjQstC10YDRgdCw0LvRjNC90LDRjyDQvtCx0YnQtdGB0YLQstC10L3QvdCw0Y8g0LvQuNGG0LXQvdC30LjRjyDRgtGA0LXQsdGD0LXRgiwg0YfRgtC+0LHRiw0K0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdGL0LUg0LLQtdGA0YHQuNC4INC/0L7QvNC10YfQsNC70LjRgdGMINC60LDQuiDigJzQuNC30LzQtdC90LXQvdC90YvQteKAnSwNCtGB0LvQtdC00L7QstCw0YLQtdC70' .
        'YzQvdC+LCDQuNGFINC/0YDQvtCx0LvQtdC80Ysg0L3QtSDQsdGD0LTRg9GCINC+0YjQuNCx0L7Rh9C90L4g0L/RgNC40YHQstC+0LXQvdGLINCw0LLRgtC+0YDQsNC8DQrQv9GA0LXQtNGL0LTRg9GJ0LjRhSDQstC10YDRgdC40LkuPC9wPg0KPHA+0J3QtdC60L7RgtC+0YDRi9C1INGD0YHRgtGA0L7QudGB0YLQstCwINGB0LrQvtC90YHRgtGA0YPQuNGA0L7QstCw0L3RiyDRgtCw0LosINGH0YLQvtCx0Ysg0LfQsNC/0YDQtdGJ0LDRgtGMDQrQv9C+0LvRjNC30L7QstCw0YLQtdC70Y/QvCDRg9GB0YLQsNC90LDQstC70LjQstCw0YLRjCDQuCDQt9Cw0L/Rg9GB0LrQsNGC0Ywg0L3QsCDQvdC40YUg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdGL0LUNCtCy0LXRgNGB0LjQuCDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4g0L7QsdC10YHQv9C10YfQtdC90LjRjywg0YXQvtGC0Y8g0L/RgNC+0LjQt9Cy0L7QtNC40YLQtdC70Ywg0LzQvtC20LXRgiDRjdGC0L4NCtC00LXQu9Cw0YLRjC4g0K3RgtC+INCw0LHRgdC+0LvRjtGC0L3QviDQvdC10YHQvtCy0LzQtdGB0YLQuNC80L4g0YEg0YbQtdC70YzRjiDQt9Cw0YnQuNGC0Ysg0YHQstC+0LHQvtC00YsNCtC/0L7Qu9GM0LfQvtCy0LDRgtC10LvQtdC5INC40LfQvNC10L3Rj9GC0Ywg0L/RgNC+0LPRgNCw0LzQvNC90L7QtSDQ' .
        'vtCx0LXRgdC/0LXRh9C10L3QuNC1LiDQodC40YHRgtC10LzQsNGC0LjRh9C10YHQutC40LkNCtGF0LDRgNCw0LrRgtC10YAg0YLQsNC60L7Qs9C+INC30LvQvtGD0L/QvtGC0YDQtdCx0LvQtdC90LjRjyDQv9GA0L7QuNGB0YXQvtC00LjRgiDQsiDRgdGE0LXRgNC1INC/0YDQvtC00YPQutGC0L7Qsg0K0LjQvdC00LjQstC40LTRg9Cw0LvRjNC90L7Qs9C+INC40YHQv9C+0LvRjNC30L7QstCw0L3QuNGPLCDQsiDQutC+0YLQvtGA0L7QuSDRjdGC0L4g0L7RgdC+0LHQtdC90L3Qvg0K0L3QtdC/0YDQuNC10LzQu9C10LzQvi4g0J/QvtGN0YLQvtC80YMsINC80Ysg0YHQvtC30LTQsNC70Lgg0Y3RgtGDINCy0LXRgNGB0LjRjiDQo9C90LjQstC10YDRgdCw0LvRjNC90L7QuQ0K0L7QsdGJ0LXRgdGC0LLQtdC90L3QvtC5INC70LjRhtC10L3Qt9C40LgsINGH0YLQvtCx0Ysg0LfQsNC/0YDQtdGC0LjRgtGMINC/0L7QtNC+0LHQvdGD0Y4g0L/RgNCw0LrRgtC40LrRgyDQsiDRjdGC0L7QuQ0K0YHRhNC10YDQtS4g0JXRgdC70Lgg0YLQsNC60LjQtSDQv9GA0L7QsdC70LXQvNGLINCy0L7Qt9C90LjQutC90YPRgiDQsiDQtNGA0YPQs9C40YUg0L7QsdC70LDRgdGC0Y/RhSwg0LzRiywg0L/Qvg0K0LzQtdGA0LUg0L3QtdC+0LHRhdC+0LTQuNC80L7RgdGC0LgsINCz0L7RgtC+0LLRiyD' .
        'RgNCw0YHRiNC40YDQuNGC0Ywg0Y3RgtC+INC/0L7Qu9C+0LbQtdC90LjQtSDQsiDRjdGC0LjRhQ0K0L7QsdC70LDRgdGC0Y/RhSDQsiDQsdGD0LTRg9GJ0LjRhSDQstC10YDRgdC40Y/RhSDQo9C90LjQstC10YDRgdCw0LvRjNC90L7QuSDQvtCx0YnQtdGB0YLQstC10L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCwNCtGH0YLQvtCx0Ysg0LfQsNGJ0LjRgtC40YLRjCDRgdCy0L7QsdC+0LTRgyDQv9C+0LvRjNC30L7QstCw0YLQtdC70LXQuS48L3A+DQo8cD7QndCw0LrQvtC90LXRhiwg0LrQsNC20LTQvtC5INC/0YDQvtCz0YDQsNC80LzQtSDQv9C+0YHRgtC+0Y/QvdC90L4g0YPQs9GA0L7QttCw0Y7RgiDQv9Cw0YLQtdC90YLRiyDQvdCwDQrQv9GA0L7Qs9GA0LDQvNC80L3QvtC1INC+0LHQtdGB0L/QtdGH0LXQvdC40LUuINCT0L7RgdGD0LTQsNGA0YHRgtCy0LAg0L3QtSDQtNC+0LvQttC90Ysg0L/QvtC30LLQvtC70Y/RgtGMINC/0LDRgtC10L3RgtCw0LwNCtC+0LPRgNCw0L3QuNGH0LjQstCw0YLRjCDRgNCw0LfRgNCw0LHQvtGC0LrRgyDQuCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjQtSDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4g0L7QsdC10YHQv9C10YfQtdC90LjRjw0K0L3QsCDQutC+0LzQv9GM0Y7RgtC10YDQsNGFINC+0LHRidC10LPQviDQvdCw0LfQvdCw0Y' .
        'fQtdC90LjRjywg0L3QviDQv9GA0LjQvNC10L3QuNGC0LXQu9GM0L3QviDQuiDRgtC10LwNCtCz0L7RgdGD0LTQsNGA0YHRgtCy0LDQvCwg0LrQvtGC0L7RgNGL0LUg0LTQtdC70LDRjtGCINGN0YLQviwg0LzRiyDRhdC+0YLQuNC8INC40LfQsdC10LbQsNGC0Ywg0L7Qv9Cw0YHQvdC+0YHRgtC4DQrQvdCw0LvQvtC20LXQvdC40Y8g0L/QsNGC0LXQvdGC0L7QsiDQvdCwINGB0LLQvtCx0L7QtNC90YvQtSDQv9GA0L7Qs9GA0LDQvNC80YssINGH0YLQviDQvNC+0LbQtdGCINGB0LTQtdC70LDRgtGMINC40YUNCtC90LXRgdCy0L7QsdC+0LTQvdGL0LzQuC4g0KfRgtC+0LHRiyDQv9GA0LXQtNC+0YLQstGA0LDRgtC40YLRjCDRjdGC0L4sINCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QsNGPINC+0LHRidC10YHRgtCy0LXQvdC90LDRjw0K0LvQuNGG0LXQvdC30LjRjyDQs9Cw0YDQsNC90YLQuNGA0YPQtdGCLCDRh9GC0L4g0Y3RgtC4INC/0LDRgtC10L3RgtGLINC90LUg0LzQvtCz0YPRgiDQsdGL0YLRjCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90YsNCtGBINGG0LXQu9GM0Y4g0YHQtNC10LvQsNGC0Ywg0L/RgNC+0LPRgNCw0LzQvNGDINC90LXRgdCy0L7QsdC+0LTQvdC+0LkuPC9wPg0KPHA+0JTQsNC70LXQtSDRgdC70LXQtNGD0Y7RgiDQutC+0L3QutGA0LXRgtC90YvQtSDRg9GB0' .
        'LvQvtCy0LjRjyDQtNC70Y8g0LrQvtC/0LjRgNC+0LLQsNC90LjRjywNCtGA0LDRgdC/0YDQvtGB0YLRgNCw0L3QtdC90LjRjyDQuCDQvNC+0LTQuNGE0LjQutCw0YbQuNC4LjwvcD4NCjxoMj7Qo9Ch0JvQntCS0JjQrzwvaDI+DQo8aDM+MC4g0J7Qv9GA0LXQtNC10LvQtdC90LjRjy48L2gzPg0KPHA+4oCc0JTQsNC90L3QsNGPINC70LjRhtC10L3Qt9C40Y/igJ0g0L/QvtC00YDQsNC30YPQvNC10LLQsNC10YIg0YLRgNC10YLRjNGOINCy0LXRgNGB0LjRjiDQo9C90LjQstC10YDRgdCw0LvRjNC90L7QuQ0K0L7QsdGJ0LXRgdGC0LLQtdC90L3QvtC5INC70LjRhtC10L3Qt9C40LggR05VLjwvcD4NCjxwPuKAnNCQ0LLRgtC+0YDRgdC60L7QtSDQv9GA0LDQstC+4oCdINGC0LDQutC20LUg0L7QsdC+0LfQvdCw0YfQsNC10YIg0LfQsNC60L7QvdGLLCDRgdGF0L7QttC40LUg0YEg0LfQsNC60L7QvdCw0LzQuA0K0L7QsSDQsNCy0YLQvtGA0YHQutC+0Lwg0L/RgNCw0LLQtSwg0L/RgNC40LzQtdC90LjQvNGL0LUg0Log0LTRgNGD0LPQuNC8INCy0LjQtNCw0Lwg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC5LA0K0L3QsNC/0YDQuNC80LXRgCwg0Log0L/QvtC70YPQv9GA0L7QstC+0LTQvdC40LrQvtCy0YvQvCDQvNC40LrRgNC+0YHRhdC10LzQsNC8LjwvcD4NCjxwPuKAnNCf0YDQ' .
        'vtCz0YDQsNC80LzQsOKAnSDQv9C+0LTRgNCw0LfRg9C80LXQstCw0LXRgiDQu9GO0LHQvtC1LCDQvtGF0YDQsNC90Y/QtdC80L7QtSDQsNCy0YLQvtGA0YHQutC40Lwg0L/RgNCw0LLQvtC8LA0K0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDQstGL0L/Rg9GJ0LXQvdC90L7QtSDQv9C+0LQg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LXQuS4g0JLQu9Cw0LTQtdC70LXRhiDQu9C40YbQtdC90LfQuNC4DQrQuNC80LXQvdGD0LXRgtGB0Y8g4oCc0LLRi+KAnS4g4oCc0JLQu9Cw0LTQtdC70YzRhtC10Lwg0LvQuNGG0LXQvdC30LjQuOKAnSDQuCDigJzQv9C+0LvRg9GH0LDRgtC10LvQtdC84oCdINC80L7QttC10YIg0LHRi9GC0YwNCtGH0LDRgdGC0L3QvtC1INC40LvQuCDRjtGA0LjQtNC40YfQtdGB0LrQvtC1INC70LjRhtC+LjwvcD4NCjxwPuKAnNCc0L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90LjQteKAnSDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8g0L7Qt9C90LDRh9Cw0LXRgiDQutC+0L/QuNGA0L7QstCw0L3QuNC1INC40LvQuA0K0LDQtNCw0L/RgtCw0YbQuNGOINCy0YHQtdCz0L4g0LjQu9C4INGH0LDRgdGC0Lgg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINCyINGE0L7RgNC80LUsINGC0YDQtdCx0YPRjtGJ0LXQuQ0K0YDQsNC30YDQtdGI0LXQvdC40LUg0LL' .
        'Qu9Cw0LTQtdC70YzRhtCwINCw0LLRgtC+0YDRgdC60LjRhSDQv9GA0LDQsiwg0LrRgNC+0LzQtSDQuNC30LPQvtGC0L7QstC70LXQvdC40Y8g0YLQvtGH0L3QvtC5DQrQutC+0L/QuNC4LiDQoNC10LfRg9C70YzRgtCw0YIg0L3QsNC30YvQstCw0LXRgtGB0Y8g4oCc0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdC+0Lkg0LLQtdGA0YHQuNC10LnigJ0NCtC/0YDQtdC00YvQtNGD0YnQtdCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINC40LvQuCDQv9GA0L7QuNC30LLQtdC00LXQvdC40LXQvCwg4oCc0L7RgdC90L7QstCw0L3QvdGL0LzigJ0g0L3QsA0K0L/RgNC10LTRi9C00YPRidC10Lwg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC4LjwvcD4NCjxwPuKAnNCb0LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LXigJ0g0L/QvtC00YDQsNC30YPQvNC10LLQsNC10YINCtC90LXQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC90YPRjiDQn9GA0L7Qs9GA0LDQvNC80YMsINC70LjQsdC+INC/0YDQvtC40LfQstC10LTQtdC90LjQtSwg0L7RgdC90L7QstCw0L3QvdC+0LUg0L3QsA0K0J/RgNC+0LPRgNCw0LzQvNC1LjwvcD4NCjxwPuKAnNCg0LDRgdC/0YDQvtGB0YLRgNCw0L3Rj9GC0YzigJ0g0L/RgNC+0LjQt9Cy0LXQtNC10L' .
        '3QuNC1INC+0LfQvdCw0YfQsNC10YIg0LTQtdC70LDRgtGMINGH0YLQvi3Qu9C40LHQviDRgSDQvdC40LwsDQrRh9GC0L4sINCx0LXQtyDRgNCw0LfRgNC10YjQtdC90LjRjywg0LTQtdC70LDQtdGCINCy0LDRgSDQvdC10L/QvtGB0YDQtdC00YHRgtCy0LXQvdC90L4sINC70LjQsdC+INC60L7RgdCy0LXQvdC90L4NCtC+0YLQstC10YLRgdGC0LLQtdC90L3Ri9C8INC30LAg0L3QsNGA0YPRiNC10L3QuNC1INC00LXQudGB0YLQstGD0Y7RidC10LPQviDQt9Cw0LrQvtC90LAg0L7QsSDQsNCy0YLQvtGA0YHQutC+0LwNCtC/0YDQsNCy0LUsINC30LAg0LjRgdC60LvRjtGH0LXQvdC40LXQvCDQt9Cw0L/Rg9GB0LrQsCDQvdCwINC60L7QvNC/0YzRjtGC0LXRgNC1INC40LvQuCDQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC40Y8NCtC70LjRh9C90L7QuSDQutC+0L/QuNC4LiDQoNCw0YHQv9GA0L7RgdGC0YDQsNC90LXQvdC40LUg0LLQutC70Y7Rh9Cw0LXRgiDQsiDRgdC10LHRjyDQutC+0L/QuNGA0L7QstCw0L3QuNC1LA0K0LTQuNGB0YLRgNC40LHRg9GG0LjRjiAo0YEg0LjQu9C4INCx0LXQtyDQvNC+0LTQuNGE0LjQutCw0YbQuNC5KSwg0L/Rg9Cx0LvQuNC60LDRhtC40Y4sINC4INGC0LDQutC20LUg0LTRgNGD0LPQuNC1DQrQstC40LTRiyDQtNC10Y/RgtC10LvRjNC90' .
        'L7RgdGC0Lgg0LIg0L3QtdC60L7RgtC+0YDRi9GFINGB0YLRgNCw0L3QsNGFLjwvcD4NCjxwPuKAnNCf0LXRgNC10LTQsNGH0LDigJ0g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINC+0LfQvdCw0YfQsNC10YIg0LvRjtCx0L7QuSDQstC40LQg0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdC10L3QuNGPLA0K0LrQvtGC0L7RgNGL0Lkg0L/QvtC30LLQvtC70Y/QtdGCINGC0YDQtdGC0YzQuNC8INC70LjRhtCw0Lwg0YHQvtC30LTQsNCy0LDRgtGMINC40LvQuCDQv9C+0LvRg9GH0LDRgtGMINC60L7Qv9C40LguDQrQn9GA0L7RgdGC0L7QtSDQstC30LDQuNC80L7QtNC10LnRgdGC0LLQuNC1INGBINC/0L7Qu9GM0LfQvtCy0LDRgtC10LvQtdC8INGH0LXRgNC10Lcg0LrQvtC80L/RjNGO0YLQtdGA0L3Rg9GOINGB0LXRgtGMLA0K0LHQtdC3INC/0L7Qu9GD0YfQtdC90LjRjyDQutC+0L/QuNC4LCDQv9C10YDQtdC00LDRh9C10Lkg0L3QtSDRj9Cy0LvRj9C10YLRgdGPLjwvcD4NCjxwPtCf0L7Qu9GM0LfQvtCy0LDRgtC10LvRjNGB0LrQuNC5INC40L3RgtC10YDRhNC10LnRgSDQvtGC0L7QsdGA0LDQttCw0LXRgiDigJzQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40LUNCtC/0YDQsNCy0L7QstGL0LUg0YPQstC10LTQvtC80LvQtdC90LjRj+KAnSDQsiDRgtCw0LrQvtC5INGB0YLQ' .
        'tdC/0LXQvdC4LCDRh9GC0L4g0L7QvdC4INCy0LrQu9GO0YfQsNGO0YIg0LIg0YHQtdCx0Y8NCtGD0LTQvtCx0L3Ri9C1INC4INC30LDQvNC10YLQvdGL0LUg0YTRg9C90LrRhtC40LgsINC60L7RgtC+0YDRi9C1ICgxKSDQvtGC0L7QsdGA0LDQttCw0Y7Rgg0K0YHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQtdC1INGD0LLQtdC00L7QvNC70LXQvdC40LUg0L7QsSDQsNCy0YLQvtGA0YHQutC+0Lwg0L/RgNCw0LLQtSwg0LggKDIpINCz0L7QstC+0YDRj9GCDQrQv9C+0LvRjNC30L7QstCw0YLQtdC70Y/QvCwg0YfRgtC+INC90LXRgiDQvdC40LrQsNC60LjRhSDQs9Cw0YDQsNC90YLQuNC5INC90LAg0YDQsNCx0L7RgtGDICjQt9CwINC40YHQutC70Y7Rh9C10L3QuNC10LwNCtGB0LvRg9GH0LDQtdCyLCDQutC+0LPQtNCwINCz0LDRgNCw0L3RgtC40Y8g0Y/QstC90L4g0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90LApLCDRh9GC0L4g0LLQu9Cw0LTQtdC70YzRhtGLDQrQu9C40YbQtdC90LfQuNC4INC80L7Qs9GD0YIg0L/QtdGA0LXQtNCw0LLQsNGC0Ywg0YDQsNCx0L7RgtGDINC/0L7QtCDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQtdC5LCDQuCDQutCw0LoNCtC80L7QttC90L4g0YPQstC40LTQtdGC0Ywg0LrQvtC/0LjRjiDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC' .
        '30LjQuC4g0JXRgdC70Lgg0LjQvdGC0LXRgNGE0LXQudGBINC/0YDQtdC00YHRgtCw0LLQu9GP0LXRgg0K0LjQtyDRgdC10LHRjyDRgdC/0LjRgdC+0Log0L/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC40YUg0LrQvtC80LDQvdC0INC4INC+0L/RhtC40LksINGC0LDQutC40YUg0LrQsNC6INC80LXQvdGOLA0K0YLQviDRgdC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40Lkg0LjQt9Cy0LXRgdGC0L3Ri9C5INC/0YPQvdC60YIg0YHQvtC+0YLQstC10YLRgdGC0LLRg9C10YIg0LTQsNC90L3QvtC80YMNCtC60YDQuNGC0LXRgNC40Y4uPC9wPg0KPGgzPjEuINCY0YHRhdC+0LTQvdGL0Lkg0LrQvtC0LjwvaDM+DQo8cD7igJzQmNGB0YXQvtC00L3Ri9C5INC60L7QtOKAnSDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8g0L7Qt9C90LDRh9Cw0LXRgiDQv9GA0LXQtNC/0L7Rh9C40YLQsNC10LzRg9GOINGE0L7RgNC80YMNCtC/0YDQvtC40LfQstC10LTQtdC90LjRjyDQtNC70Y8g0YHQvtC30LTQsNC90LjRjyDQtdCz0L4g0LzQvtC00LjRhNC40LrQsNGG0LjQuS4g4oCc0J7QsdGK0LXQutGC0L3Ri9C5INC60L7QtOKAnQ0K0L7Qt9C90LDRh9Cw0LXRgiDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUg0LIg0LvRjtCx0L7QuSDQvdC10LjRgdGF0L7QtNC90L7QuSDRhNC+0YDQvNC1Lj' .
        'wvcD4NCjxwPuKAnNCh0YLQsNC90LTQsNGA0YLQvdGL0Lkg0LjQvdGC0LXRgNGE0LXQudGB4oCdINC+0LfQvdCw0YfQsNC10YIg0LjQvdGC0LXRgNGE0LXQudGBLCDQutC+0YLQvtGA0YvQuSDQu9C40LHQvg0K0Y/QstC70Y/QtdGC0YHRjyDQvtGE0LjRhtC40LDQu9GM0L3Ri9C8INGB0YLQsNC90LTQsNGA0YLQvtC8LCDRg9GB0YLQsNC90L7QstC70LXQvdC90YvQvCDQvtGA0LPQsNC90L7QvCDQv9C+DQrRgdGC0LDQvdC00LDRgNGC0LjQt9Cw0YbQuNC4LCDQu9C40LHQviwg0LIg0YHQu9GD0YfQsNC1INC40L3RgtC10YDRhNC10LnRgdC+0LIsINGB0L/QtdGG0LjRhNC40YfQvdGL0YUg0LTQu9GPDQrQutC+0L3QutGA0LXRgtC90L7Qs9C+INGP0LfRi9C60LAg0L/RgNC+0LPRgNCw0LzQvNC40YDQvtCy0LDQvdC40Y8sINGC0L7Rgiwg0YfRgtC+INGI0LjRgNC+0LrQviDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90LXQvQ0K0YHRgNC10LTQuCDRgNCw0LfRgNCw0LHQvtGC0YfQuNC60L7QsiDQvdCwINC00LDQvdC90L7QvCDRj9C30YvQutC1LjwvcD4NCjxwPuKAnNCh0LjRgdGC0LXQvNC90YvQtSDQsdC40LHQu9C40L7RgtC10LrQuOKAnSDQuNGB0L/QvtC70L3Rj9C10LzRi9GFINC/0YDQvtC40LfQstC10LTQtdC90LjQuSDQstC60LvRjtGH0LDRjtGCINCyDQrRgdC10LHRjyDQs' .
        'tGB0LUsINC60YDQvtC80LUg0YDQsNCx0L7RgtGLINCyINGG0LXQu9C+0LwsINGH0YLQviAo0LApINCy0YXQvtC00LjRgiDQsiDQvdC+0YDQvNCw0LvRjNC90YPRjiDRhNC+0YDQvNGDDQrQv9C+0YHRgtCw0LLQutC4INCT0LvQsNCy0L3QvtCz0L4g0JrQvtC80L/QvtC90LXQvdGC0LAsINC90L4g0LrQvtGC0L7RgNCw0Y8g0L3QtSDRj9Cy0LvRj9C10YLRgdGPINGH0LDRgdGC0YzRjiDRjdGC0L7Qs9C+DQrQk9C70LDQstC90L7Qs9C+INCa0L7QvNC/0L7QvdC10L3RgtCwLCDQuCAo0LEpINGB0LvRg9C20LjRgiDRgtC+0LvRjNC60L4g0LTQu9GPINC40YHQv9C+0LvRjNC30L7QstCw0L3QuNGPINCyDQrRgNCw0LHQvtGC0LUg0YEg0JPQu9Cw0LLQvdGL0Lwg0JrQvtC80L/QvtC90LXQvdGC0L7QvCwg0LvQuNCx0L4g0LTQu9GPINC/0YDQtdC00L7RgdGC0LDQstC70LXQvdC40Y8NCtCh0YLQsNC90LTQsNGA0YLQvdC+0LPQviDQuNC90YLQtdGA0YTQtdC50YHQsCwg0LTQu9GPINC60L7RgtC+0YDRi9GFINGA0LXQsNC70LjQt9Cw0YbQuNGPINC00L7RgdGC0YPQv9C90LAg0LTQu9GPDQrQvtCx0YnQtdGB0YLQstC10L3QvdC+0YHRgtC4INCyINGE0L7RgNC80LUg0LjRgdGF0L7QtNC90L7Qs9C+INC60L7QtNCwLiAi0JPQu9Cw0LLQvdGL0Lkg0JrQvtC80L/QvtC90LXQvdGCIiDQ' .
        'siDRjdGC0L7QvA0K0LrQvtC90YLQtdC60YHRgtC1INC+0LfQvdCw0YfQsNC10YIg0LPQu9Cw0LLQvdGL0Lkg0YHRg9GJ0LXRgdGC0LLQtdC90L3Ri9C5INC60L7QvNC/0L7QvdC10L3RgiAo0Y/QtNGA0L4sINC+0LrQvtC90L3QsNGPDQrRgdC40YHRgtC10LzQsCDQuCDRgi7QtC4pINC60L7QvdC60YDQtdGC0L3QvtC5INC+0L/QtdGA0LDRhtC40L7QvdC90L7QuSDRgdC40YHRgtC10LzRiyAo0LXRgdC70Lgg0YLQsNC60L7QstGL0LUNCtC40LzQtdGO0YLRgdGPKSwg0L3QsCDQutC+0YLQvtGA0L7QuSDQstGL0L/QvtC70L3Rj9C10YLRgdGPINC/0YDQvtC40LfQstC10LTQtdC90LjQtSwg0LvQuNCx0L4g0LrQvtC80L/QuNC70Y/RgtC+0YAsDQrQuNGB0L/QvtC70YzQt9C+0LLQsNC90L3Ri9C5INC00LvRjyDRgdC+0LfQtNCw0L3QuNGPINC/0YDQvtC40LfQstC10LTQtdC90LjRjywg0LvQuNCx0L4g0LjQvdGC0LXRgNC/0YDQtdGC0LDRgtC+0YANCtC+0LHRitC10LrRgtC90L7Qs9C+INC60L7QtNCwLCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90L3Ri9C5INC00LvRjyDQt9Cw0L/Rg9GB0LrQsCDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8uPC9wPg0KPHA+4oCc0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC5INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC04oCdINC/0YDQvtC' .
        '40LfQstC10LTQtdC90LjRjyDQsiDRhNC+0YDQvNC1INC+0LHRitC10LrRgtC90L7Qs9C+DQrQutC+0LTQsCDQv9C+0LTRgNCw0LfRg9C80LXQstCw0LXRgiDQstC10YHRjCDQuNGB0YXQvtC00L3Ri9C5INC60L7QtCwg0L3QtdC+0LHRhdC+0LTQuNC80YvQuSDQtNC70Y8g0YHQvtC30LTQsNC90LjRjywNCtGD0YHRgtCw0L3QvtCy0LrQuCDQuCAo0LTQu9GPINC40YHQv9C+0LvQvdGP0LXQvNGL0YUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC5KSDQt9Cw0L/Rg9GB0LrQsCDQvtCx0YrQtdC60YLQvdC+0LPQvg0K0LrQvtC00LAg0Lgg0LzQvtC00LjRhNC40LrQsNGG0LjQuCDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8sINCy0LrQu9GO0YfQsNGPINGB0LrRgNC40L/RgtGLLCDQutC+0L3RgtGA0L7Qu9C40YDRg9GO0YnQuNC1DQrRjdGC0Lgg0LTQtdC50YHRgtCy0LjRjy4g0KLQtdC8INC90LUg0LzQtdC90LXQtSwg0L7QvSDQvdC1INGB0L7QtNC10YDQttC40YIg0KHQuNGB0YLQtdC80L3Ri9C1INCx0LjQsdC70LjQvtGC0LXQutC4DQrQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8sINC40LvQuCDQuNC90YHRgtGA0YPQvNC10L3RgtGLINC+0LHRidC10LPQviDQvdCw0LfQvdCw0YfQtdC90LjRjywg0LjQu9C4INC+0LHRidC40LUNCtGB0LLQvtCx0L7QtNC90YvQtSDQv9GA0L7Qs9' .
        'GA0LDQvNC80YssINC60L7RgtC+0YDRi9C1INC40YHQv9C+0LvRjNC30L7QstCw0LvQuNGB0Ywg0LIg0L3QtdC80L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90L3QvtC8DQrQstC40LTQtSDQtNC70Y8g0L7RgdGD0YnQtdGB0YLQstC70LXQvdC40Y8g0LTQtdGP0YLQtdC70YzQvdC+0YHRgtC4LCDQvdC+INC90LUg0Y/QstC70Y/RjtGC0YHRjyDRh9Cw0YHRgtGM0Y4NCtC/0YDQvtC40LfQstC10LTQtdC90LjRjy4g0J3QsNC/0YDQuNC80LXRgCwg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC5INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC0INCy0LrQu9GO0YfQsNC10YINCtGE0LDQudC70Ysg0L7Qv9GA0LXQtNC10LvQtdC90LjRjyDQuNC90YLQtdGA0YTQtdC50YHQsCwg0YHQstGP0LfQsNC90L3Ri9C1INGBINC40YHRhdC+0LTQvdGL0LzQuCDRhNCw0LnQu9Cw0LzQuCwg0LTQu9GPDQrRgNCw0LHQvtGC0YssINC4INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC0INC+0LHRidC40YUg0LHQuNCx0LvQuNC+0YLQtdC6INC4INC00LjQvdCw0LzQuNGH0LXRgdC60Lgg0YHQstGP0LfQsNC90L3Ri9GFDQrQv9C+0LTQv9GA0L7Qs9GA0LDQvNC8LCDQutC+0YLQvtGA0YvQtSDQvdC10L7QsdGF0L7QtNC40LzRiyDQtNC70Y8g0L/RgNGP0LzQvtC5INC/0LXRgNC10LTQsNGH0Lgg0LTQsNC90' .
        'L3Ri9GFLCDQuNC70LgNCtGD0L/RgNCw0LLQu9C10L3QuNGPINC/0L7RgtC+0LrQvtC8INC80LXQttC00YMg0Y3RgtC40LzQuCDQv9C+0LTQv9GA0L7Qs9GA0LDQvNC80LDQvNC4INC4INC00YDRg9Cz0LjRhSDRh9Cw0YHRgtC10LkNCtGN0YLQvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLjwvcD4NCjxwPtCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtCDQvdC1INC+0LHRj9C30LDQvSDQstC60LvRjtGH0LDRgtGMINCyINGB0LXQsdGPINGC0L4sINGH0YLQvg0K0L/QvtC70YzQt9C+0LLQsNGC0LXQu9C4INC80L7Qs9GD0YIg0LDQstGC0L7QvNCw0YLQuNGH0LXRgdC60Lgg0YHQs9C10L3QtdGA0LjRgNC+0LLQsNGC0Ywg0LjQtyDQvtGB0YLQsNC70YzQvdGL0YUNCtGH0LDRgdGC0LXQuSDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC10LPQviDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAuPC9wPg0KPHA+0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC5INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC0INC/0YDQvtC40LfQstC10LTQtdC90LjRjyDQsiDRhNC+0YDQvNC1INC40YHRhdC+0LTQvdC+0LPQvg0K0LrQvtC00LAg0Y/QstC70Y/QtdGC0YHRjyDRjdGC0LjQvCDQttC1INC/0YDQvtC40LfQstC10LTQtdC9' .
        '0LjQtdC8LjwvcD4NCjxoMz4yLiDQntGB0L3QvtCy0L3Ri9C1INGB0LLQvtCx0L7QtNGLLjwvaDM+DQo8cD7QktGB0LUg0L/RgNCw0LLQsCwg0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90L3Ri9C1INGB0L7Qs9C70LDRgdC90L4g0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LgNCtC/0YDQtdC00L7RgdGC0LDQstC70Y/RjtGC0YHRjyDQvdCwINGB0YDQvtC6INC00LXQudGB0YLQstC40Y8g0LDQstGC0L7RgNGB0LrQvtCz0L4g0L/RgNCw0LLQsCDQvdCwINCf0YDQvtCz0YDQsNC80LzRgywg0LgNCtC90LUg0LzQvtCz0YPRgiDQsdGL0YLRjCDQvtGC0L7Qt9Cy0LDQvdGLINC/0YDQuCDRg9GB0LvQvtCy0LjQuCwg0YfRgtC+INGD0YHRgtCw0L3QvtCy0LvQtdC90L3Ri9C1INGD0YHQu9C+0LLQuNGPDQrRgdC+0LHQu9GO0LTQtdC90YsuINCU0LDQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPINC+0LTQvdC+0LfQvdCw0YfQvdC+INC/0L7QtNGC0LLQtdGA0LbQtNCw0LXRgiDQstCw0YjQuA0K0L3QtdC+0LPRgNCw0L3QuNGH0LXQvdC90YvQtSDQv9GA0LDQstCwINC90LAg0LfQsNC/0YPRgdC6INC90LXQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC90L7QuSDQn9GA0L7Qs9GA0LDQvNC80YsuDQrQlNC10LnRgdGC0LLQuNC1INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC' .
        '4INC90LAg0LLRi9Cy0L7QtCDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8sINC30LDRidC40YnQtdC90L3QvtCz0L4NCtCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC10LksINGA0LDRgdC/0YDQvtGB0YLRgNCw0L3Rj9C10YLRgdGPINGC0L7Qu9GM0LrQviDQsiDRgtC+0Lwg0YHQu9GD0YfQsNC1LCDQtdGB0LvQuA0K0LLRi9Cy0L7QtCDQv9GA0LXQtNGB0YLQsNCy0LvRj9C10YIg0YHQvtCx0L7QuSDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LiDQlNCw0L3QvdCw0Y8NCtC70LjRhtC10L3Qt9C40Y8g0L/RgNC40LfQvdCw0LXRgiDQstCw0YjQuCDQv9GA0LDQstCwINC90LAg0YHQstC+0LHQvtC00L3QvtC1INC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC1INC40LvQuCDQtdCz0L4NCtGN0LrQstC40LLQsNC70LXQvdGCINCyINGB0L7QvtGC0LLQtdGC0YHRgtCy0LjQuCDRgSDQt9Cw0LrQvtC90L7QvCDQvtCxINCw0LLRgtC+0YDRgdC60L7QvCDQv9GA0LDQstC1LjwvcD4NCjxwPtCS0Ysg0LzQvtC20LXRgtC1INGB0L7Qt9C00LDQstCw0YLRjCwg0LfQsNC/0YPRgdC60LDRgtGMINC4INGA0LDRgdC/0YDQvtGB0YLRgNCw0L3Rj9GC0YwNCtC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90YvQtSDQv9GA0L7QuNC30LLQtd' .
        'C00LXQvdC40Y8sINC60L7RgtC+0YDRi9C1INCy0Ysg0L3QtSDQv9C10YDQtdC00LDQtdGC0LUsINC00L4g0YLQtdGFDQrQv9C+0YAsINC/0L7QutCwINGD0YHQu9C+0LLQuNGPINC70LjRhtC10L3Qt9C40Lgg0L7RgdGC0LDRjtGC0YHRjyDQsiDRgdC40LvQtS4g0JLRiyDQvNC+0LbQtdGC0LUg0L/QtdGA0LXQtNCw0LLQsNGC0YwNCtC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUg0YLRgNC10YLRjNC40Lwg0LvQuNGG0LDQvCDRgtC+0LvRjNC60L4g0LTQu9GPINGC0L7Qs9C+LCDRh9GC0L7QsdGLDQrQvtC90Lgg0LTQtdC70LDQu9C4INGN0LrRgdC60LvRjtC30LjQstC90YvQtSDQtNC70Y8g0LLQsNGBINC80L7QtNC40YTQuNC60LDRhtC40Lgg0LjQu9C4INC00LvRjw0K0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90LjRjyDQstCw0Lwg0LLQvtC30LzQvtC20L3QvtGB0YLQuCDQt9Cw0L/Rg9GB0LrQsNGC0Ywg0Y3RgtC4INC/0YDQvtC40LfQstC10LTQtdC90LjRjywg0L/RgNC4DQrRg9GB0LvQvtCy0LjQuCwg0YfRgtC+INCy0Ysg0LLRi9C/0L7Qu9C90Y/QtdGC0LUg0YPRgdC70L7QstC40Y8g0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40Lgg0L/RgNC4INC/0LXRgNC10LTQsNGH0LUNCtC80LDRgtC10YDQuNCw0LvQv' .
        'tCyLCDQvdCwINC60L7RgtC+0YDRi9C1INC90LUg0L7QsdC70LDQtNCw0LXRgtC1INCw0LLRgtC+0YDRgdC60LjQvCDQv9GA0LDQstC+0LwuINCi0LUsINC60YLQvg0K0YHQvtC30LTQsNC10YIg0LjQu9C4INC30LDQv9GD0YHQutCw0LXRgiDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdGL0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLCDQtNC+0LvQttC90Ysg0LTQtdC70LDRgtGMDQrRjdGC0L4g0L7RgiDQstCw0YjQtdCz0L4g0LjQvNC10L3QuCwg0L/QvtC0INCy0LDRiNC40Lwg0YDRg9C60L7QstC+0LTRgdGC0LLQvtC8INC4INC60L7QvdGC0YDQvtC70LXQvCwg0L3QsA0K0YPRgdC70L7QstC40Y/RhSDQt9Cw0L/RgNC10YLQsCDRgdC+0LfQtNCw0L3QuNGPINC60L7Qv9C40Lkg0LzQsNGC0LXRgNC40LDQu9C+0LIsINC90LDRhdC+0LTRj9GJ0LjRhdGB0Y8g0L/QvtC0DQrQtNC10LnRgdGC0LLQuNC10Lwg0LDQstGC0L7RgNGB0LrQvtCz0L4g0L/RgNCw0LLQsCwg0LHQtdC3INCy0LDRiNC10LPQviDRgNCw0LfRgNC10YjQtdC90LjRjy48L3A+DQo8cD7Qn9C10YDQtdC00LDRh9CwINC/0YDQuCDQu9GO0LHRi9GFINC00YDRg9Cz0LjRhSDQvtCx0YHRgtC+0Y/RgtC10LvRjNGB0YLQstCw0YUg0YDQsNC30YDQtdGI0LXQvdCwDQrQuNGB0LrQu9GO0YfQuNGC0LXQu9GM' .
        '0L3QviDQv9GA0Lgg0YPRgdC70L7QstC40Y/RhSwg0YPRgdGC0LDQvdC+0LLQu9C10L3QvdGL0YUg0L3QuNC20LUuINCh0YPQsdC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC40LUNCtC30LDQv9GA0LXRidC10L3Qvjsg0YDQsNC30LTQtdC7IDEwINC40YHQutC70Y7Rh9Cw0LXRgiDQvdC10L7QsdGF0L7QtNC40LzQvtGB0YLRjCDQsiDRjdGC0L7QvC48L3A+DQo8aDM+My4g0JfQsNGJ0LjRgtCwINC70LXQs9Cw0LvRjNC90YvRhSDQv9GA0LDQsiDQv9C+0LvRjNC30L7QstCw0YLQtdC70LXQuSDQvtGCINC30LDQutC+0L3QvtCyLA0K0LfQsNC/0YDQtdGJ0LDRjtGJ0LjRhSDQvtCx0YXQvtC0INGC0LXRhdC90LjRh9C10YHQutC40YUg0YHRgNC10LTRgdGC0LIg0LfQsNGJ0LjRgtGLINCw0LLRgtC+0YDRgdC60LjRhSDQv9GA0LDQsi48L2gzPg0KPHA+0J3QuCDQvtC00L3QviDQuNC3INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90YvRhSDQv9GA0L7QuNC30LLQtdC00LXQvdC40Lkg0L3QtSDQtNC+0LvQttC90L4g0YHRh9C40YLQsNGC0YzRgdGPDQrRh9Cw0YHRgtGM0Y4g0Y3RhNGE0LXQutGC0LjQstC90L7QuSDRgtC10YXQvdC+0LvQvtCz0LjRh9C10YHQutC+0Lkg0LzQtdGA0Ysg0LfQsNGJ0LjRgtGLINGB0L7Qs9C70LDRgdC90L4g0LvRjtCx0L7QvNGDDQrQv9GA0LjQvNC' .
        '10L3QuNC80L7QvNGDINC30LDQutC+0L3Rgywg0LLRi9C/0L7Qu9C90Y/RjtGJ0LXQvNGDINC+0LHRj9C30LDRgtC10LvRjNGB0YLQstCwINCyINGB0L7QvtGC0LLQtdGC0YHRgtCy0LjQuCDRgdC+DQrRgdGC0LDRgtGM0LXQuSAxMSDQtNC+0LPQvtCy0L7RgNCwINC/0L4g0LDQstGC0L7RgNGB0LrQvtC80YMg0L/RgNCw0LLRgyDQktGB0LXQvNC40YDQvdC+0Lkg0L7RgNCz0LDQvdC40LfQsNGG0LjQuA0K0LjQvdGC0LXQu9C70LXQutGC0YPQsNC70YzQvdC+0Lkg0YHQvtCx0YHRgtCy0LXQvdC90L7RgdGC0Lgg0L7RgiAyMCDQtNC10LrQsNCx0YDRjyAxOTk2INCz0L7QtNCwLCDQuNC70LgNCtGB0YXQvtC20LjQvCDQt9Cw0LrQvtC90LDQvCwg0LfQsNC/0YDQtdGJ0LDRjtGJ0LjQvCDQuNC70Lgg0L7Qs9GA0LDQvdC40YfQuNCy0LDRjtGJ0LjQvCDQvtCx0YXQvtC0INGC0LDQutC40YUNCtC80LXRgC48L3A+DQo8cD7QmtC+0LPQtNCwINCy0Ysg0L/QtdGA0LXQtNCw0LXRgtC1INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUsINCy0YsNCtC+0YLQutCw0LfRi9Cy0LDQtdGC0LXRgdGMINC+0YIg0LrQsNC60LjRhS3Qu9C40LHQviDQu9C10LPQsNC70YzQvdGL0YUg0L/QvtC70L3QvtC80L7Rh9C40Lkg0LfQsNC/0YDQtdGJ0L' .
        'DRgtGMINC+0LHRhdC+0LQNCtGC0LXRhdC90LjRh9C10YHQutC40YUg0YHRgNC10LTRgdGC0LIsINC/0L7QutCwINGC0LDQutC+0Lkg0L7QsdGF0L7QtCDQvdCw0YXQvtC00LjRgtGB0Y8g0LIg0YDQsNC80LrQsNGFDQrQvtGB0YPRidC10YHRgtCy0LvQtdC90LjRjyDQv9GA0LDQsiDQv9C+INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4INC+0YLQvdC+0YHQuNGC0LXQu9GM0L3Qvg0K0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC5INGA0LDQt9GA0LDQsdC+0YLQutC4LCDQuCDQstGLINC+0YLQutCw0LfRi9Cy0LDQtdGC0LXRgdGMINC+0YIg0LvRjtCx0YvRhSDQvdCw0LzQtdGA0LXQvdC40LkNCtC+0LPRgNCw0L3QuNGH0LjRgtGMINGA0LDQsdC+0YLRgyDQuNC70Lgg0LzQvtC00LjRhNC40LrQsNGG0LjRjiDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8sINC60LDQuiDRgdGA0LXQtNGB0YLQsg0K0LTQsNCy0LvQtdC90LjRjywg0L3QsNC/0YDQsNCy0LvQtdC90L3Ri9GFINC90LAg0L/QvtC70YzQt9C+0LLQsNGC0LXQu9C10Lkg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLCDQstCw0YjQuA0K0LfQsNC60L7QvdC90YvQtSDQv9GA0LDQstCwINC4INC/0YDQsNCy0LAg0YLRgNC10YLRjNC40YUg0LvQuNGGINC30LDQv9GA0LXRgtC40YLRjCDQvtCx0YXQvtC0DQrRg' .
        'tC10YXQvdC+0LvQvtCz0LjRh9C10YHQutC40YUg0YHRgNC10LTRgdGC0LIg0LfQsNGJ0LjRgtGLLjwvcD4NCjxoMz40LiDQn9C10YDQtdC00LDRh9CwINGC0L7Rh9C90YvRhSDQutC+0L/QuNC5LjwvaDM+DQo8cD7QktGLINC80L7QttC10YLQtSDQv9C10YDQtdC00LDQstCw0YLRjCDRgtC+0YfQvdGL0LUg0LrQvtC/0LjQuCDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAg0J/RgNC+0LPRgNCw0LzQvNGLINGC0LDQug0K0LbQtSwg0LrQsNC6INC4INC/0L7Qu9GD0YfQuNC70Lgg0LXQs9C+INC90LAg0LvRjtCx0L7QvCDQvdC+0YHQuNGC0LXQu9C1LCDQv9GA0Lgg0YPRgdC70L7QstC40LgsINGH0YLQviDQstGLINCyDQrQt9Cw0LzQtdGC0L3QvtC5INC4INGB0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LXQuSDRhNC+0YDQvNC1INC/0L7QvNC10YnQsNC10YLQtSDQvdCwINC60LDQttC00L7QuSDQutC+0L/QuNC4DQrRgdC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC10LUg0YPQstC10LTQvtC80LvQtdC90LjQtSDQvtCxINCw0LLRgtC+0YDRgdC60LjRhSDQv9GA0LDQstCw0YU7INGB0L7RhdGA0LDQvdGP0LXRgtC1DQrQvdC10YLRgNC+0L3Rg9GC0YvQvNC4INCy0YHQtSDRg9Cy0LXQtNC+0LzQu9C10L3QuNGPINC+INGC0L7QvCwg0YfRgtC+INCU0LDQvdC90LDRjyDQu9C4' .
        '0YbQtdC90LfQuNGPINC4INC70Y7QsdGL0LUNCtC+0LPRgNCw0L3QuNGH0LjQstCw0Y7RidC40LUg0YPRgdC70L7QstC40Y8sINC00L7QsdCw0LLQu9C10L3QvdGL0LUg0LIg0YHQvtC+0YLQstC10YLRgdGC0LLQuNC4INGBINGA0LDQt9C00LXQu9C+0LwgNywNCtC/0YDQuNC80LXQvdC40LzRiyDQuiDQuNGB0YXQvtC00L3QvtC80YMg0LrQvtC00YMg0L/RgNC+0LPRgNCw0LzQvNGLOyDRgdC+0YXRgNCw0L3Rj9C10YLQtSDQstGB0LUg0YPQstC10LTQvtC80LvQtdC90LjRjw0K0L7QsSDQvtGC0YHRg9GC0YHRgtCy0LjQuCDQs9Cw0YDQsNC90YLQuNC5OyDQuCDQv9GA0LXQtNC+0YHRgtCw0LLQu9GP0LXRgtC1INCy0YHQtdC8INC/0L7Qu9GD0YfQsNGC0LXQu9GP0Lwg0LrQvtC/0LjRjg0K0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40Lgg0LLQvNC10YHRgtC1INGBINCf0YDQvtCz0YDQsNC80LzQvtC5LjwvcD4NCjxwPtCS0Ysg0LzQvtC20LXRgtC1INGD0YHRgtCw0L3QvtCy0LjRgtGMINC40LvQuCDQvdC1INGD0YHRgtCw0L3QsNCy0LvQuNCy0LDRgtGMINGG0LXQvdGDINC30LAg0LrQsNC20LTRg9GODQrQutC+0L/QuNGOLCDRh9GC0L4g0LLRiyDQv9C10YDQtdC00LDQu9C4LCDQuCDQstGLINC80L7QttC10YLQtSDQv9GA0LXQtNC70LDQs9Cw0YLRjCDQv9C+0LTQtNC' .
        '10YDQttC60YMg0LjQu9C4DQrQs9Cw0YDQsNC90YLQuNGOINC30LAg0L/Qu9Cw0YLRgy48L3A+DQo8aDM+NS4g0J/QtdGA0LXQtNCw0YfQsCDQstC10YDRgdC40Lkg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdC+0LPQviDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAuPC9oMz4NCjxwPtCS0Ysg0LzQvtC20LXRgtC1INC/0LXRgNC10LTQsNGC0Ywg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDQvtGB0L3QvtCy0LDQvdC90L7QtSDQvdCwINCf0YDQvtCz0YDQsNC80LzQtSwg0LjQu9C4DQrQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC90YPRjiDQn9GA0L7Qs9GA0LDQvNC80YMg0LIg0YTQvtGA0LzQtSDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAg0LIg0YHQvtC+0YLQstC10YLRgdGC0LLQuNC4DQrRgSDRg9GB0LvQvtCy0LjRj9C80Lgg0YDQsNC30LTQtdC70LAgNCwg0LAg0YLQsNC60LbQtSDQstGL0L/QvtC70L3Rj9GPINGB0LvQtdC00YPRjtGJ0LjQtSDRg9GB0LvQvtCy0LjRjzo8L3A+DQo8dWw+DQogIDxsaT5hKSDQn9GA0L7QuNC30LLQtdC00LXQvdC40LUg0LTQvtC70LbQvdC+INGB0L7QtNC10YDQttCw0YLRjCDQt9Cw0LzQtdGC0L3Ri9C1INGD0LLQtdC00L7QvNC70LXQvdC40Y8sDQogINGD0YLQstC10YDQttC00LDRjtGJ0LjQtSwg0YfRgtC+IN' .
        'Cy0Ysg0LjQt9C80LXQvdC40LvQuCDQtdCz0L4g0Lgg0LTQtdC50YHRgtCy0LjRgtC10LvRjNC90YPRjiDQtNCw0YLRgw0KICDQuNC30LzQtdC90LXQvdC40LkuPC9saT4NCiAgPGxpPmIpINCf0YDQvtC40LfQstC10LTQtdC90LjQtSDQtNC+0LvQttC90L4g0YHQvtC00LXRgNC20LDRgtGMINC30LDQvNC10YLQvdGL0LUg0YPQstC10LTQvtC80LvQtdC90LjRjywNCiAg0YPRgtCy0LXRgNC20LTQsNGO0YnQuNC1LCDRh9GC0L4g0L7QvdC+INCy0YvQv9GD0YnQtdC90L4g0L/QvtC0INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC10Lkg0Lgg0LvRjtCx0YvQvNC4DQogINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LzQuCDRg9GB0LvQvtCy0LjRj9C80LgsINGD0LrQsNC30LDQvdC90YvQvNC4INCyINGA0LDQt9C00LXQu9C1IDcuINCU0LDQvdC90L7QtQ0KICDRgtGA0LXQsdC+0LLQsNC90LjQtSDQuNC30LzQtdC90Y/QtdGCINGC0YDQtdCx0L7QstCw0L3QuNC1INGA0LDQt9C00LXQu9CwIDQg4oCc0L7RgdGC0LDQstC70Y/RgtGMINC90LXRgtGA0L7QvdGD0YLRi9C80LgNCiAg0LLRgdC1INGD0LLQtdC00L7QvNC70LXQvdC40Y/igJ0uPC9saT4NCiAgPGxpPmMpINCS0Ysg0LTQvtC70LbQvdGLINC70LjRhtC10L3Qt9C40YDQvtCy0LDRgtGMINCy0YHQtSDQv9GA0L7Qu' .
        'NC30LLQtdC00LXQvdC40LUg0LIg0YbQtdC70L7QvCDQv9C+0LQNCiAg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LXQuSDQtNC70Y8g0LLRgdC10YUsINC60YLQviDQstGB0YLRg9C/0LDQtdGCINCy0L4g0LLQu9Cw0LTQtdC90LjQtSDQutC+0L/QuNC10LkuDQogINCU0LDQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPINCx0YPQtNC10YIg0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdGP0YLRjNGB0Y8g0LLQvNC10YHRgtC1INGBINC70Y7QsdGL0LzQuA0KICDQv9GA0LjQvNC10L3QuNC80YvQvNC4INGD0YHQu9C+0LLQuNGP0LzQuCDRgNCw0LfQtNC10LvQsCA3INC90LAg0LLRgdC1INC/0YDQvtC40LfQstC10LTQtdC90LjQtSDQuCDQstGB0LUg0LXQs9C+DQogINGH0LDRgdGC0LgsINC90LXQt9Cw0LLQuNGB0LjQvNC+INC+0YIg0YLQvtCz0L4sINC60LDQuiDQvtC90Lgg0L/QvtGB0YLQsNCy0LvRj9GO0YLRgdGPLiDQlNCw0L3QvdCw0Y8NCiAg0LvQuNGG0LXQvdC30LjRjyDQvdC1INC00LDQtdGCINGA0LDQt9GA0LXRiNC10L3QuNGPINC00LvRjyDQstGL0LTQsNGH0Lgg0LvQuNGG0LXQvdC30LjQuSDQvdCwINC/0YDQvtC40LfQstC10LTQtdC90LjQtQ0KICDQtNGA0YPQs9C40LzQuCDRgdC/0L7RgdC+0LHQsNC80LgsINC90L4g0L3QtSDQt9Cw0L/RgNC10YnQsNC10YIg' .
        '0Y3RgtC+0LPQviwg0LXRgdC70Lgg0LLRiyDQv9C+0LvRg9GH0LjQu9C4INC10LPQvg0KICDQvtGC0LTQtdC70YzQvdC+LjwvbGk+DQogIDxsaT5kKSDQldGB0LvQuCDQsiDQv9GA0L7QuNC30LLQtdC00LXQvdC40Lgg0L/RgNC40YHRg9GC0YHRgtCy0YPRjtGCINC40L3RgtC10YDQsNC60YLQuNCy0L3Ri9C1DQogINC/0L7Qu9GM0LfQvtCy0LDRgtC10LvRjNGB0LrQuNC1INC40L3RgtC10YDRhNC10LnRgdGLLCDQutCw0LbQtNGL0Lkg0LTQvtC70LbQtdC9INC+0YLQvtCx0YDQsNC20LDRgtGMDQogINCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQtSDQv9GA0LDQstC+0LLRi9C1INGD0LLQtdC00L7QvNC70LXQvdC40Y87INC+0LTQvdCw0LrQviwg0LXRgdC70Lgg0J/RgNC+0LPRgNCw0LzQvNCwDQogINC40LzQtdC10YIg0LjQvdGC0LXRgNCw0LrRgtC40LLQvdGL0LUg0LjQvdGC0LXRgNGE0LXQudGB0YssINC60L7RgtC+0YDRi9C1INC90LUg0L7RgtC+0LHRgNCw0LbQsNGO0YINCiAg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC1INC/0YDQsNCy0L7QstGL0LUg0YPQstC10LTQvtC80LvQtdC90LjRjywg0YLQviDQstCw0YjQtdC80YMg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGOINC90LUNCiAg0L7QsdGP0LfQsNGC0LXQu9GM0L3QviDQvtGC0L7QsdGA0LDQttC' .
        'w0YLRjCDQuNGFLjwvbGk+DQo8L3VsPg0KPHA+0JrQvtC80L/QuNC70Y/RhtC40Y8g0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINGBINC00YDRg9Cz0LjQvNC4INC+0YLQtNC10LvRjNC90YvQvNC4DQrQuCDQvdC10LfQsNCy0LjRgdC40LzRi9C80Lgg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGP0LzQuCwg0LrQvtGC0L7RgNGL0LUg0L3QtSDRj9Cy0LvRj9GO0YLRgdGPINC/0L4g0YHQstC+0LXQuQ0K0L/RgNC40YDQvtC00LUg0YDQsNGB0YjQuNGA0LXQvdC40Y/QvNC4INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7Qs9C+INC/0YDQvtC40LfQstC10LTQtdC90LjRjyDQuCDQvdC1INGB0L7QtdC00LjQvdC10L3Riw0K0YEg0L3QuNC8INGBINGG0LXQu9GM0Y4g0YHRhNC+0YDQvNC40YDQvtCy0LDRgtGMINCx0L7Qu9GM0YjRg9GOINC/0YDQvtCz0YDQsNC80LzRgyDQvdCwINC90L7RgdC40YLQtdC70LUNCtGF0YDQsNC90LXQvdC40Y8sINC90LDQt9GL0LLQsNC10YLRgdGPIOKAnNCw0LPRgNC10LPQsNGG0LjQtdC54oCdLCDQtdGB0LvQuCDQutC+0LzQv9C40LvRj9GG0LjRjyDQuCDQtdC1INC40YLQvtCz0L7QstGL0LUNCtCw0LLRgtC+0YDRgdC60LjQtSDQv9GA0LDQstCwINC90LUg0LjRgdC/0L7Qu9GM0LfRg9' .
        'GO0YLRgdGPINGBINGG0LXQu9GM0Y4g0L7Qs9GA0LDQvdC40YfQtdC90LjRjyDQtNC+0YHRgtGD0L/QsCDQuNC70LgNCtC70LXQs9Cw0LvRjNC90YvRhSDQv9GA0LDQsiDQv9C+0LvRjNC30L7QstCw0YLQtdC70Y8g0LrQvtC80L/QuNC70Y/RhtC40Lgg0L7RgtC90L7RgdC40YLQtdC70YzQvdC+INC40YHRhdC+0LTQvdC+0LPQvg0K0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLiDQktC60LvRjtGH0LXQvdC40LUg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINCyINCw0LPRgNC10LPQsNGG0LjRjg0K0L3QtSDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90Y/QtdGCINC00LXQudGB0YLQstC40LUg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40Lgg0L3QsCDQvtGB0YLQsNC70YzQvdGL0LUg0YfQsNGB0YLQuA0K0LDQs9GA0LXQs9Cw0YbQuNC4LjwvcD4NCjxoMz42LiDQn9C10YDQtdC00LDRh9CwINC90LXQuNGB0YXQvtC00L3Ri9GFINGE0L7RgNC8LjwvaDM+DQo8cD7QktGLINC80L7QttC10YLQtSDQv9C10YDQtdC00LDQstCw0YLRjCDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdGL0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINCyINGE0L7RgNC80LUNCtC+0LHRitC10LrRgtC90L7Qs9C+INC60L7QtNCwINC90LAg0' .
        'YPRgdC70L7QstC40Y/RhSDRgNCw0LfQtNC10LvQvtCyIDQg0LggNSwg0LAg0YLQsNC60LbQtSDQv9GA0Lgg0YPRgdC70L7QstC40LgsDQrRh9GC0L4g0LLRiyDQv9C10YDQtdC00LDQtdGC0LUg0LzQsNGI0LjQvdC+0YfQuNGC0LDQtdC80YvQuSDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40Lkg0LjRgdGF0L7QtNC90YvQuSDQutC+0LQg0L3QsA0K0YPRgdC70L7QstC40Y/RhSDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQvtC00L3QuNC8INC40Lcg0YHQu9C10LTRg9GO0YnQuNGFINGB0L/QvtGB0L7QsdC+0LI6PC9wPg0KPHVsPg0KICA8bGk+YSkg0J/QtdGA0LXQtNCw0LXRgtC1INC+0LHRitC10LrRgtC90YvQuSDQutC+0LQg0LIgKNC40LvQuCDQstGB0YLRgNC+0LXQvdC90YvQvCDQsikg0YTQuNC30LjRh9C10YHQutC40LkNCiAg0L/RgNC+0LTRg9C60YIgKNCy0LrQu9GO0YfQsNGPINGE0LjQt9C40YfQtdGB0LrQuNC5INC90L7RgdC40YLQtdC70Ywg0LTQuNGB0YLRgNC40LHRg9GC0LjQstCwKSDQstC80LXRgdGC0LUg0YENCiAg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC8INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC00L7QvCwg0YDQsNGB0L/QvtC70L7QttC10L3QvdC+0Lwg0L3QsCDRhNC40LfQuNGH0LXRgdC60L7QvA0KICDQvdC+0YHQuNGC' .
        '0LXQu9C1LCDQvtCx0YvRh9C90L4g0LjRgdC/0L7Qu9GM0LfRg9C10LzRi9C8INC00LvRjyDQvtCx0LzQtdC90LAg0L/RgNC+0LPRgNCw0LzQvNC90YvQvA0KICDQvtCx0LXRgdC/0LXRh9C10L3QuNC10LwuPC9saT4NCiAgPGxpPmIpINCf0LXRgNC10LTQsNC10YLQtSDQvtCx0YrQtdC60YLQvdGL0Lkg0LrQvtC0INCyICjQuNC70Lgg0LLRgdGC0YDQvtC10L3QvdGL0Lwg0LIpINGE0LjQt9C40YfQtdGB0LrQuNC5DQogINC/0YDQvtC00YPQutGCICjQstC60LvRjtGH0LDRjyDRhNC40LfQuNGH0LXRgdC60LjQuSDQvdC+0YHQuNGC0LXQu9GMINC00LjRgdGC0YDQuNCx0YPRgtC40LLQsCkg0LLQvNC10YHRgtC1INGBDQogINC/0LjRgdGM0LzQtdC90L3Ri9C8INC/0YDQtdC00LvQvtC20LXQvdC40LXQvCwg0LTQtdC50YHRgtCy0LjRgtC10LvRjNC90YvQvCwg0L/QviDQutGA0LDQudC90LXQuSDQvNC10YDQtSwg0YLRgNC4DQogINCz0L7QtNCwINC4INC00L4g0YLQtdGFINC/0L7RgCwg0L/QvtC60LAg0LLRiyDQv9GA0LXQtNC+0YHRgtCw0LLQu9GP0LXRgtC1INC30LDQv9Cw0YHQvdGL0LUg0YfQsNGB0YLQuCDQuNC70LgNCiAg0LrQu9C40LXQvdGC0YHQutGD0Y4g0L/QvtC00LTQtdGA0LbQutGDINC00LvRjyDQtNCw0L3QvdC+0Lkg0LzQvtC00LXQu9C4INC/0YDQvtC00YP' .
        'QutGC0LAsINGH0YLQvtCx0Ysg0LTQsNGC0YwNCiAg0LrQsNC20LTQvtC80YMsINC60YLQviDQvtCx0LvQsNC00LDQtdGCINC+0LHRitC10LrRgtC90YvQvCDQutC+0LTQvtC8INC70LjQsdC+ICgxKSDQutC+0L/QuNGODQogINCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LXQs9C+INC40YHRhdC+0LTQvdC+0LPQviDQutC+0LTQsCDQtNC70Y8g0LLRgdC10LPQviDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4NCiAg0L7QsdC10YHQv9C10YfQtdC90LjRjywg0LLRhdC+0LTRj9GJ0LXQs9C+INCyINC/0YDQvtC00YPQutGCLCDQutC+0YLQvtGA0L7QtSDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QviDQlNCw0L3QvdC+0LkNCiAg0LvQuNGG0LXQvdC30LjQtdC5LCDQvdCwINGE0LjQt9C40YfQtdGB0LrQvtC8INC90L7RgdC40YLQtdC70LUsINC+0LHRi9GH0L3QviDQuNGB0L/QvtC70YzQt9GD0LXQvNC+0Lwg0LTQu9GPDQogINC+0LHQvNC10L3QsCDQv9GA0L7Qs9GA0LDQvNC80L3Ri9C8INC+0LHQtdGB0L/QtdGH0LXQvdC40LXQvCDQv9C+INGG0LXQvdC1LCDQvdC1INC/0YDQtdCy0YvRiNCw0Y7RidC10Lkg0LLQsNGI0LgNCiAg0LfQsNGC0YDQsNGC0Ysg0L3QsCDQstGL0L/QvtC70L3QtdC90LjQtSDQv9C10YDQtdC00LDRh9C4INC40YHRhdC+0LTQvdC+0LPQviDQutC+0L' .
        'TQsCwg0LvQuNCx0L4gKDIpDQogINCy0L7Qt9C80L7QttC90L7RgdGC0Ywg0YHQutC+0L/QuNGA0L7QstCw0YLRjCDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40Lkg0LjRgdGF0L7QtNC90YvQuSDQutC+0LQg0YEg0YHQtdGC0LXQstC+0LPQvg0KICDRgdC10YDQstC10YDQsCDQsdC10Lcg0LLQt9C40LzQsNC90LjRjyDQv9C70LDRgtGLLjwvbGk+DQogIDxsaT5jKSDQn9C10YDQtdC00LDQtdGC0LUg0LjQvdC00LjQstC40LTRg9Cw0LvRjNC90YvQtSDQutC+0L/QuNC4INC+0LHRitC10LrRgtC90L7Qs9C+INC60L7QtNCwINGBINC60L7Qv9C40LXQuQ0KICDQv9C40YHRjNC80LXQvdC90L7Qs9C+INC+0LHQtdGJ0LDQvdC40Y8g0L4g0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90LjQuCDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC10LPQvg0KICDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAuINCi0LDQutC+0Lkg0LDQu9GM0YLQtdGA0L3QsNGC0LjQstC90YvQuSDRgdC/0L7RgdC+0LEg0LTQvtC/0YPRgdC60LDQtdGC0YHRjyDRgtC+0LvRjNC60L4NCiAg0LIg0YDQtdC00LrQuNGFINGB0LvRg9GH0LDRj9GFINC4INC90LAg0L3QtdC60L7QvNC80LXRgNGH0LXRgdC60L7QuSDQvtGB0L3QvtCy0LUsINC4INGC0L7Qu9GM0LrQviDQtdGB0LvQuCDQstGLDQogINC/0' .
        'L7Qu9GD0YfQuNC70Lgg0L7QsdGK0LXQutGC0L3Ri9C5INC60L7QtCDQsiDRhNC+0YDQvNC1LCDRgdC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC10Lkg0L/Rg9C90LrRgtGDIGINCiAg0YDQsNC30LTQtdC70LAgNi48L2xpPg0KICA8bGk+ZCkg0J/QtdGA0LXQtNCw0LXRgtC1INC+0LHRitC10LrRgtC90YvQuSDQutC+0LQsINC/0YDQtdC00L7RgdGC0LDQstC70Y/RjyDQtNC+0YHRgtGD0L8g0LjQtw0KICDQvtCx0L7Qt9C90LDRh9C10L3QvdC+0LPQviDQvNC10YHRgtCwICjQsdC10YHQv9C70LDRgtC90L4g0LjQu9C4INC/0LvQsNGC0L3QviksINC4INC/0YDQtdC00L7RgdGC0LDQstC70Y/QtdGC0LUNCiAg0LDQvdCw0LvQvtCz0LjRh9C90YvQuSDQtNC+0YHRgtGD0L8g0Log0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQtdC80YMg0LjRgdGF0L7QtNC90L7QvNGDINC60L7QtNGDLCDRgtCw0LrQuNC8INC20LUNCiAg0YHQv9C+0YHQvtCx0L7QvCwg0LjQtyDRgtCw0LrQvtCz0L4g0LbQtSDQvNC10YHRgtCwLCDQsdC10Lcg0L/QvtGB0LvQtdC00YPRjtGJ0LXQuSDQvtC/0LvQsNGC0YsuINCS0LDQvCDQvdC1DQogINC90YPQttC90L4g0L/RgNC10LTQvtGB0YLQsNCy0LvRj9GC0Ywg0L/QvtC70YPRh9Cw0YLQtdC70Y/QvCDQutC+0L/QuNGOINCh0L7QvtGC0LLQtdGC0YHR' .
        'gtCy0YPRjtGJ0LXQs9C+DQogINC40YHRhdC+0LTQvdC+0LPQviDQutC+0LTQsCDQstC80LXRgdGC0LUg0YEg0L7QsdGK0LXQutGC0L3Ri9C8INC60L7QtNC+0LwuINCV0YHQu9C4INC80LXRgdGC0L7QvCDQtNC70Y8NCiAg0LrQvtC/0LjRgNC+0LLQsNC90LjRjyDRj9Cy0LvRj9C10YLRgdGPINGB0LXRgtC10LLQvtC5INGB0LXRgNCy0LXRgCwg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC5INC40YHRhdC+0LTQvdGL0LkNCiAg0LrQvtC0INC80L7QttC10YIg0LHRi9GC0Ywg0YDQsNGB0L/QvtC70L7QttC10L0g0L3QsCDQtNGA0YPQs9C+0Lwg0YHQtdGA0LLQtdGA0LUgKNC+0LHRgdC70YPQttC40LLQsNC10LzQvtC8INCy0LDQvNC4DQogINC40LvQuCDRgtGA0LXRgtGM0LjQvNC4INC70LjRhtCw0LzQuCksINC/0L7QtNC00LXRgNC20LjQstCw0Y7RidC10Lwg0LDQvdCw0LvQvtCz0LjRh9C90YvQtSDRgdGA0LXQtNGB0YLQstCwDQogINC60L7Qv9C40YDQvtCy0LDQvdC40Y8sINC/0YDQuCDRg9GB0LvQvtCy0LjQuCwg0YfRgtC+INC+0LHRitC10LrRgtC90YvQuSDQutC+0LQg0LTQvtC70LbQtdC9DQogINGB0L7Qv9GA0L7QstC+0LbQtNCw0YLRjNGB0Y8g0Y/RgdC90YvQvNC4INGD0LrQsNC30LDQvdC40Y/QvNC4LCDQs9C00LUg0LzQvtC20L3QviDQvdCw0LnRgtC' .
        '4DQogINCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtC4g0JLRiyDQtNC+0LvQttC90Ysg0YPQsdC10LTQuNGC0YzRgdGPLCDRh9GC0L4g0Y3RgtC+DQogINCy0L7Qt9C80L7QttC90L4g0LTQviDRgtC10YUg0L/QvtGALCDQv9C+0LrQsCDQtdGB0YLRjCDQvdC10L7QsdGF0L7QtNC40LzQvtGB0YLRjCDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Y8NCiAg0LTQsNC90L3Ri9C8INGC0YDQtdCx0L7QstCw0L3QuNGP0LwuPC9saT4NCiAgPGxpPmUpINCf0LXRgNC10LTQsNC10YLQtSDQvtCx0YrQtdC60YLQvdGL0Lkg0LrQvtC0LCDQuNGB0L/QvtC70YzQt9GD0Y8g0L/QuNGA0LjQvdCz0L7QstGD0Y4g0YHQtdGC0YwsDQogINGB0L7QvtCx0YnQsNGPINC00YDRg9Cz0LjQvCDQv9C+0LvRg9GH0LDRgtC10LvRj9C8LCDQs9C00LUg0L3QsNGF0L7QtNC40YLRgdGPINC+0LHRitC10LrRgtC90YvQuSDQutC+0LQsINC4DQogINCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtCDQtNC70Y8g0YDQsNCx0L7RgtGLINC/0YPQsdC70LjRh9C90L4g0LTQvtGB0YLRg9C/0LXQvSDQsdC10LcNCiAg0LLQt9C40LzQsNC90LjRjyDQv9C70LDRgtGLINGB0L7Qs9C70LDRgdC90L4g0L/Rg9C90LrRgtGDIG' .
        'Qg0YDQsNC30LTQtdC70LAgNi48L2xpPg0KPC91bD4NCjxwPtCSINC/0LXRgNC10LTQsNGH0YMg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINCyINGE0L7RgNC80LUg0L7QsdGK0LXQutGC0L3QvtCz0L4g0LrQvtC00LAg0L3QtSDQvdGD0LbQvdC+DQrQstC60LvRjtGH0LDRgtGMINC+0YLQtNC10LvQuNC80YvQtSDRh9Cw0YHRgtC4INC+0LHRitC10LrRgtC90L7Qs9C+INC60L7QtNCwLCDRh9C10Lkg0LjRgdGF0L7QtNC90YvQuSDQutC+0LQNCtC40YHQutC70Y7Rh9C10L0g0LjQtyDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC10LPQviDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LAg0LrQsNC6INCh0LjRgdGC0LXQvNC90LDRjw0K0LHQuNCx0LvQuNC+0YLQtdC60LAuPC9wPg0KPHA+4oCc0J/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC40Lkg0L/RgNC+0LTRg9C60YLigJ0g0Y3RgtC+INC70LjQsdC+ICgxKSDigJzQv9C+0YLRgNC10LHQuNGC0LXQu9GM0YHQutC40LkNCtGC0L7QstCw0YDigJ0sINC60L7RgtC+0YDRi9C5INC+0LfQvdCw0YfQsNC10YIg0LvRjtCx0YvQtSDRhNC+0YDQvNGLINC80LDRgtC10YDQuNCw0LvRjNC90L7Qs9C+INC/0LXRgNGB0L7QvdCw0LvRjNC90L7Qs9C+DQrQuNC80YPRidC10YHRgtCy0LAsINC60L7RgtC+0YDRi9C1INC+0LHRi' .
        '9GH0L3QviDQuNGB0L/QvtC70YzQt9GD0Y7RgtGB0Y8g0LTQu9GPINC/0LXRgNGB0L7QvdCw0LvRjNC90YvRhSwg0YHQtdC80LXQudC90YvRhQ0K0LjQu9C4INC00L7QvNCw0YjQvdC40YUg0YbQtdC70LXQuSwg0LjQu9C4ICgyKSDRh9GC0L4t0L3QuNCx0YPQtNGMINGB0L7Qt9C00LDQvdC90L7QtSDQuNC70Lgg0L/RgNC+0LTQsNGO0YnQtdC10YHRjw0K0LTQu9GPINGD0YHRgtCw0L3QvtCy0LrQuCDQsiDQttC40LvRjNC1LiDQn9GA0Lgg0L7Qv9GA0LXQtNC10LvQtdC90LjQuCwg0Y/QstC70Y/QtdGC0YHRjyDQu9C4INC/0YDQvtC00YPQutGCDQrQv9C+0YLRgNC10LHQuNGC0LXQu9GM0YHQutC40Lwg0YLQvtCy0LDRgNC+0LwsINGB0L7QvNC90LjRgtC10LvRjNC90YvQtSDRgdC70YPRh9Cw0Lgg0LTQvtC70LbQvdGLINCx0YvRgtGMINGA0LXRiNC10L3RiyDQsg0K0L/QvtC70YzQt9GDINC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC40Y8uINCU0LvRjyDQutC+0L3QutGA0LXRgtC90L7Qs9C+INC/0YDQvtC00YPQutGC0LAsINC/0L7Qu9GD0YfQtdC90L3QvtCz0L4NCtC60L7QvdC60YDQtdGC0L3Ri9C8INC/0L7Qu9GM0LfQvtCy0LDRgtC10LvQtdC8IOKAnNC+0LHRi9GH0L3QvtC1INC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC14oCdINC/0L7QtNGA0LDQt9GD0LzQtdCy' .
        '0LDQtdGCDQrRgtC40L/QuNGH0L3QvtC1INC40LvQuCDQvtCx0YnQtdC1INC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC1INGN0YLQvtCz0L4g0LrQu9Cw0YHRgdCwINC/0YDQvtC00YPQutGC0LAsDQrQvdC10LfQsNCy0LjRgdC40LzQviDQvtGCINGB0YLQsNGC0YPRgdCwINC60L7QvdC60YDQtdGC0L3QvtCz0L4g0L/QvtC70YzQt9C+0LLQsNGC0LXQu9GPINC40LvQuCDRgtC+0LPQviwg0LrQsNC60LjQvA0K0L7QsdGA0LDQt9C+0Lwg0LrQvtC90LrRgNC10YLQvdGL0Lkg0L/QvtC70YzQt9C+0LLQsNGC0LXQu9GMINC40YHQv9C+0LvRjNC30YPQtdGCLCDQuNC70Lgg0YDQsNGB0YHRh9C40YLRi9Cy0LDQtdGCLCDRh9GC0L4NCtCx0YPQtNC10YIg0LjRgdC/0L7Qu9GM0LfQvtCy0LDRgtGMINC/0YDQvtC00YPQutGCLiDQn9GA0L7QtNGD0LrRgiDRj9Cy0LvRj9C10YLRgdGPINC/0L7RgtGA0LXQsdC40YLQtdC70YzRgdC60LjQvA0K0YLQvtCy0LDRgNC+0Lwg0L3QtdC30LDQstC40YHQuNC80L4g0L7RgiDRgtC+0LPQviwg0LjQvNC10LXRgiDQu9C4INC+0L0g0YHRg9GJ0LXRgdGC0LLQtdC90L3Ri9C1DQrQutC+0LzQvNC10YDRh9C10YHQutC40LUsINC/0YDQvtC80YvRiNC70LXQvdC90YvQtSDQuNC70Lgg0L3QtdC/0L7RgtGA0LXQsdC40YLQtdC70YzRgdC60LjQtSDQv9G' .
        'A0LjQvNC10L3QtdC90LjRjyDQtNC+DQrRgtC10YUg0L/QvtGALCDQv9C+0LrQsCDRgtCw0LrQuNC1INC/0YDQuNC80LXQvdC10L3QuNGPINC90LUg0Y/QstC70Y/RjtGC0YHRjyDQtdC00LjQvdGB0YLQstC10L3QvdGL0LzQuA0K0YHRg9GJ0LXRgdGC0LLQtdC90L3Ri9C80Lgg0L/RgNC40LzQtdC90LXQvdC40Y/QvNC4INC/0YDQvtC00YPQutGC0LAuPC9wPg0KPHA+4oCc0JjQvdGE0L7RgNC80LDRhtC40Y8g0LTQu9GPINGD0YHRgtCw0L3QvtCy0LrQuOKAnSDQtNC70Y8g0J/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC+0LPQviDQv9GA0L7QtNGD0LrRgtCwDQrQvtC30L3QsNGH0LDQtdGCINC80LXRgtC+0LTRiywg0L/RgNC+0YbQtdC00YPRgNGLLCDQutC70Y7Rh9C4INC00L7RgdGC0YPQv9CwINC40LvQuCDQtNGA0YPQs9GD0Y4g0LjQvdGE0L7RgNC80LDRhtC40Y4sDQrQvdC10L7QsdGF0L7QtNC40LzRg9GOINC00LvRjyDRg9GB0YLQsNC90L7QstC60Lgg0Lgg0LfQsNC/0YPRgdC60LAg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdGL0YUg0LLQtdGA0YHQuNC5DQrQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LPQviDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8g0LIg0J/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC+0Lwg0L/RgNC+0LTRg9C60YLQtS' .
        'DQuNC3DQrQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC90L7QuSDQstC10YDRgdC40Lgg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQtdCz0L4g0LjRgdGF0L7QtNC90L7Qs9C+INC60L7QtNCwLg0K0JjQvdGE0L7RgNC80LDRhtC40Y8g0LTQvtC70LbQvdCwINCx0YvRgtGMINC00L7RgdGC0LDRgtC+0YfQvdCwINC00LvRjyDRgtC+0LPQviwg0YfRgtC+0LHRiyDQvtCx0LXRgdC/0LXRh9C40YLRjA0K0L/RgNC+0LTQvtC70LbQtdC90LjQtSDRhNGD0L3QutGG0LjQvtC90LjRgNC+0LLQsNC90LjRjyDQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDQvdC90L7Qs9C+INC+0LHRitC10LrRgtC90L7Qs9C+INC60L7QtNCwDQrQsdC10Lcg0LrQsNC60LjRhS3Qu9C40LHQviDQv9GA0LXQv9GP0YLRgdGC0LLQuNC5INC40LvQuCDQv9C+0LzQtdGFINC/0L4g0L/RgNC40YfQuNC90LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QvdGL0YUNCtC40LfQvNC10L3QtdC90LjQuS48L3A+DQo8cD7QldGB0LvQuCDQstGLINC/0LXRgNC10LTQsNC10YLQtSDQvtCx0YrQtdC60YLQvdGL0Lkg0LrQvtC0INGB0L7Qs9C70LDRgdC90L4g0YPRgdC70L7QstC40Y/QvCDRjdGC0L7Qs9C+DQrRgNCw0LfQtNC10LvQsCwg0LjQu9C4INGBLCDQuNC70Lgg0YHQv9C10YbQuNCw0LvRjNC90L4g0LTQu9GPINC40' .
        'YHQv9C+0LvRjNC30L7QstCw0L3QuNGPINCyLA0K0J/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC+0Lwg0L/RgNC+0LTRg9C60YLQtSwg0Lgg0L/QtdGA0LXQtNCw0YfQsCDQv9GA0L7QuNGB0YXQvtC00LjRgiDQutCw0Log0YfQsNGB0YLRjA0K0YLRgNCw0L3Qt9Cw0LrRhtC40LgsINCyINC60L7RgtC+0YDQvtC5INC/0YDQsNCy0L4g0LLQu9Cw0LTQtdC90LjRjyDQuCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjRjw0K0J/QvtC70YzQt9C+0LLQsNGC0LXQu9GM0YHQutC+0LPQviDQv9GA0L7QtNGD0LrRgtCwINC/0LXRgNC10LTQsNC90L4g0L/QvtC70YPRh9Cw0YLQtdC70Y4g0L3QsCDQvdC10L7Qs9GA0LDQvdC40YfQtdC90L3Ri9C5DQrRgdGA0L7QuiDQuNC70Lgg0L3QsCDQvtC/0YDQtdC00LXQu9C10L3QvdGL0Lkg0YHRgNC+0LogKNC90LUg0LfQsNCy0LjRgdC40LzQviDQvtGCINGC0L7Qs9C+LCDQutCw0LoNCtGF0LDRgNCw0LrRgtC10YDQuNC30YPQtdGC0YHRjyDRgtGA0LDQvdC30LDQutGG0LjRjykg0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC5INC40YHRhdC+0LTQvdGL0Lkg0LrQvtC0LA0K0L/QtdGA0LXQtNCw0L3QvdGL0Lkg0YHQvtCz0LvQsNGB0L3QviDRjdGC0L7QvNGDINGA0LDQt9C00LXQu9GDLCDQtNC+0LvQttC10L0g0YHQvtC/0YDQvtCy' .
        '0L7QttC00LDRgtGM0YHRjw0K0JjQvdGE0L7RgNC80LDRhtC40LXQuSDQtNC70Y8g0YPRgdGC0LDQvdC+0LLQutC4LiDQndC+INGN0YLQviDRgtGA0LXQsdC+0LLQsNC90LjQtSDQvdC1INC/0YDQuNC80LXQvdGP0LXRgtGB0Y8sINC10YHQu9C4DQrQvdC4INCy0YssINC90Lgg0YLRgNC10YLRjNGPINGB0YLQvtGA0L7QvdCwINC90LUg0LjQvNC10LXRgtC1INCy0L7Qt9C80L7QttC90L7RgdGC0Lgg0YPRgdGC0LDQvdC+0LLQuNGC0YwNCtC80L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90L3Ri9C5INC+0LHRitC10LrRgtC90YvQuSDQutC+0LQg0L3QsCDQn9C+0LvRjNC30L7QstCw0YLQtdC70YzRgdC60LjQuSDQv9GA0L7QtNGD0LrRgg0KKNC90LDQv9GA0LjQvNC10YAsINC/0YDQvtC40LfQstC10LTQtdC90LjQtSDQsdGL0LvQviDRg9GB0YLQsNC90L7QstC70LXQvdC+INCyINCf0JfQoykuPC9wPg0KPHA+0KLRgNC10LHQvtCy0LDQvdC40LUg0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90LjRjyDQmNC90YTQvtGA0LzQsNGG0LjQuCDQtNC70Y8g0YPRgdGC0LDQvdC+0LLQutC4INC90LUg0LLQutC70Y7Rh9Cw0LXRgg0K0LIg0YHQtdCx0Y8g0YLRgNC10LHQvtCy0LDQvdC40LUg0L/RgNC+0LTQvtC70LbQsNGC0Ywg0L7QutCw0LfRi9Cy0LDRgtGMINC/0L7QtNC00LXRgNC20Lr' .
        'Rgywg0LPQsNGA0LDQvdGC0LjRjiwg0LjQu9C4DQrQvtCx0L3QvtCy0LvQtdC90LjRjyDQtNC70Y8g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLCDQutC+0YLQvtGA0L7QtSDQsdGL0LvQviDQuNC30LzQtdC90LXQvdC+INC40LvQuA0K0YPRgdGC0LDQvdC+0LLQu9C10L3QviDQv9C+0LvRg9GH0LDRgtC10LvQtdC8LCDQuNC70Lgg0LTQu9GPINCf0L7Qu9GM0LfQvtCy0LDRgtC10LvRjNGB0LrQvtCz0L4g0L/RgNC+0LTRg9C60YLQsCwg0LINCtC60L7RgtC+0YDQvtC8INC+0L3QviDQsdGL0LvQviDQuNC30LzQtdC90LXQvdC+INC40LvQuCDRg9GB0YLQsNC90L7QstC70LXQvdC+LiDQkiDQtNC+0YHRgtGD0L/QtSDQuiDRgdC10YLQuCDQvNC+0LbQtdGCDQrQsdGL0YLRjCDQvtGC0LrQsNC30LDQvdC+LCDQutC+0LPQtNCwINC80L7QtNC40YTQuNC60LDRhtC40Y8g0YHRg9GJ0LXRgdGC0LLQtdC90L3QviDQuCDQvdC10LPQsNGC0LjQstC90L4g0LLQu9C40Y/QtdGCDQrQvdCwINGA0LDQsdC+0YLRgyDRgdC10YLQuCwg0LvQuNCx0L4g0L3QsNGA0YPRiNCw0LXRgiDQv9GA0LDQstC40LvQsCDQuCDQv9GA0L7RgtC+0LrQvtC70Ysg0L/QtdGA0LXQtNCw0YfQuCDQtNCw0L3QvdGL0YUNCtCyINGB0LXRgtC4LjwvcD4NCjxwPtCf0LXRgNC10LTQsNC90L3Ri9C1INCh0L7QvtGC0L' .
        'LQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtCDQuCDQmNC90YTQvtGA0LzQsNGG0LjRjyDQtNC70Y8NCtGD0YHRgtCw0L3QvtCy0LrQuCDQsiDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Lgg0YEg0YPRgdC70L7QstC40Y/QvNC4INC00LDQvdC90L7Qs9C+INGA0LDQt9C00LXQu9CwINC00L7Qu9C20L3RiyDQsdGL0YLRjA0K0L/RgNC10LTRgdGC0LDQstC70LXQvdGLINCyINGE0L7RgNC80LDRgtC1INC+0LHRidC10LTQvtGB0YLRg9C/0L3QvtC5INC00L7QutGD0LzQtdC90YLQsNGG0LjQuCAo0LjQvNC10Y7RidC10LwNCtGA0LXQsNC70LjQt9Cw0YbQuNGOLCDQtNC+0YHRgtGD0L/QvdGD0Y4g0LIg0YTQvtGA0LzQtSDQuNGB0YXQvtC00L3QvtCz0L4g0LrQvtC00LApINC4INC90LUg0LTQvtC70LbQvdGLDQrRgtGA0LXQsdC+0LLQsNGC0Ywg0YHQv9C10YbQuNCw0LvRjNC90L7Qs9C+INC/0LDRgNC+0LvRjyDQuNC70Lgg0LrQu9GO0YfQsCDQtNC70Y8g0YDQsNGB0L/QsNC60L7QstC60LgsINGH0YLQtdC90LjRjw0K0LjQu9C4INC60L7Qv9C40YDQvtCy0LDQvdC40Y8uPC9wPg0KPGgzPjcuINCU0L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LUg0YPRgdC70L7QstC40Y8uPC9oMz4NCjxwPuKAnNCU0L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LUg0' .
        'YPRgdC70L7QstC40Y/igJ0g0Y3RgtC+INGD0YHQu9C+0LLQuNGPLCDQutC+0YLQvtGA0YvQtSDQtNC+0L/QvtC70L3Rj9GO0YINCtGD0YHQu9C+0LLQuNGPINCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4LCDQtNC10LvQsNGPINC40YHQutC70Y7Rh9C10L3QuNGPINC40Lcg0L7QtNC90L7Qs9C+INC40LvQuA0K0L3QtdGB0LrQvtC70YzQutC40YUg0YPRgdC70L7QstC40LkuINCU0L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LUg0YPRgdC70L7QstC40Y8sINC/0YDQuNC80LXQvdC40LzRi9C1INC60L4g0LLRgdC10LkNCtCf0YDQvtCz0YDQsNC80LzQtSwg0LTQvtC70LbQvdGLINGA0LDRgdGB0LzQsNGC0YDQuNCy0LDRgtGM0YHRjyDRgtCw0LosINC60LDQuiDQtdGB0LvQuCDQsdGLINC+0L3QuCDQsdGL0LvQuA0K0LLQutC70Y7Rh9C10L3RiyDQsiDQlNCw0L3QvdGD0Y4g0LvQuNGG0LXQvdC30LjRjiwg0L/RgNC4INGD0YHQu9C+0LLQuNC4LCDRh9GC0L4g0L7QvdC4INC00LXQudGB0YLQstC40YLQtdC70YzQvdGLDQrRgdC+0LPQu9Cw0YHQvdC+INC00LXQudGB0YLQstGD0Y7RidC10LzRgyDQt9Cw0LrQvtC90L7QtNCw0YLQtdC70YzRgdGC0LLRgy4g0JXRgdC70Lgg0LTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvQtQ0K0YHQstC+0LHQvtC00Ysg0L/RgNC40LzQtdC9' .
        '0Y/RjtGC0YHRjyDRgtC+0LvRjNC60L4g0Log0YfQsNGB0YLQuCDQn9GA0L7Qs9GA0LDQvNC80YssINGC0L4g0Y3RgtC+INGH0LDRgdGC0Ywg0LzQvtC20LXRgg0K0LHRi9GC0Ywg0LjRgdC/0L7Qu9GM0LfQvtCy0LDQvdCwINC+0YLQtNC10LvRjNC90L4g0L3QsCDRjdGC0LjRhSDRg9GB0LvQvtCy0LjRj9GFLCDQvdC+INCy0YHRjyDQn9GA0L7Qs9GA0LDQvNC80LANCtC+0YHRgtCw0LXRgtGB0Y8g0L/QvtC0INC00LXQudGB0YLQstC40LXQvCDQlNCw0L3QvdC+0Lkg0JvQuNGG0LXQvdC30LjQuCDQsdC10Lcg0YPRh9C10YLQsCDQtNC+0L/QvtC70L3QuNGC0LXQu9GM0L3Ri9GFDQrRgdCy0L7QsdC+0LQuPC9wPg0KPHA+0JrQvtCz0LTQsCDQstGLINC/0LXRgNC10LTQsNC10YLQtSDQutC+0L/QuNGOINC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7Qs9C+INC/0YDQvtC40LfQstC10LTQtdC90LjRjywg0LLRiw0K0LzQvtC20LXRgtC1LCDQv9C+INGB0LLQvtC10LzRgyDRg9GB0LzQvtGC0YDQtdC90LjRjiwg0YPQsdGA0LDRgtGMINC70Y7QsdGL0LUg0LTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvQtSDRgdCy0L7QsdC+0LTRiw0K0LjQtyDRjdGC0L7QuSDQutC+0L/QuNC4LCDQuNC70Lgg0LvRjtCx0YPRjiDQtdCz0L4g0YfQsNGB0YLRjC4gKNCU0L7Qv9C+0LvQvdC40YL' .
        'QtdC70YzQvdGL0LUg0YPRgdC70L7QstC40Y8g0LzQvtCz0YPRgg0K0YLRgNC10LHQvtCy0LDRgtGMINC40YUg0YPQtNCw0LvQtdC90LjRjyDQsiDQvtC/0YDQtdC00LXQu9C10L3QvdGL0YUg0YHQu9GD0YfQsNGP0YUsINC60L7Qs9C00LAg0LLRiw0K0LzQvtC00LjRhNC40YbQuNGA0YPQtdGC0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1Likg0JLRiyDQvNC+0LbQtdGC0LUg0LTQvtCx0LDQstC40YLRjCDQtNC+0L/QvtC70L3QuNGC0LXQu9GM0L3Ri9C1DQrRgdCy0L7QsdC+0LTRiyDQvdCwINC80LDRgtC10YDQuNCw0LssINC00L7QsdCw0LLQu9C10L3QvdGL0Lkg0LLQsNC80Lgg0Log0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC5DQrRgNCw0LfRgNCw0LHQvtGC0LrQtSwg0LTQu9GPINC60L7RgtC+0YDQvtC5INCy0Ysg0LjQvNC10LXRgtC1INC40LvQuCDQvNC+0LbQtdGC0LUg0L/RgNC10LTQvtGB0YLQsNCy0LjRgtGMDQrRgNCw0LfRgNC10YjQtdC90LjQtSDQstC70LDQtNC10LvRjNGG0LAg0LDQstGC0L7RgNGB0LrQuNGFINC/0YDQsNCyLjwvcD4NCjxwPtCd0LXRgdC80L7RgtGA0Y8g0L3QsCDQu9GO0LHRi9C1INC00YDRg9Cz0LjQtSDQv9C+0LvQvtC20LXQvdC40Y8g0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LgsINC90LANCtC80LDRgtC10YDQuN' .
        'Cw0LssINC00L7QsdCw0LLQu9C10L3QvdGL0Lkg0LLQsNC80Lgg0Log0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC5INGA0LDQt9GA0LDQsdC+0YLQutC1LCDQstGLDQrQvNC+0LbQtdGC0LUgKNC10YHQu9C4INGA0LDQt9GA0LXRiNC10L3QviDQstC70LDQtNC10LvRjNGG0LXQvCDQsNCy0YLQvtGA0YHQutC40YUg0L/RgNCw0LIg0L3QsCDQvNCw0YLQtdGA0LjQsNC7KQ0K0LTQvtC/0L7Qu9C90LjRgtGMINGD0YHQu9C+0LLQuNGPINCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4INGB0LvQtdC00YPRjtGJ0LjQvNC4INGD0YHQu9C+0LLQuNGP0LzQuDo8L3A+DQo8dWw+DQogIDxsaT5hKSDQntGC0LrQsNC3INC+0YIg0LPQsNGA0LDQvdGC0LjQuSDQuNC70Lgg0L7Qs9GA0LDQvdC40YfQtdC90LjRjyDQvtGC0LLQtdGC0YHRgtCy0LXQvdC90L7RgdGC0Lgg0LjQvdCw0YfQtSwNCiAg0YfQtdC8INCyINGA0LDQt9C00LXQu9Cw0YUgMTUg0LggMTYg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40Lg7INC40LvQuDwvbGk+DQogIDxsaT5iKSDQotGA0LXQsdC+0LLQsNC90LjQtSDRgdC+0YXRgNCw0L3QtdC90LjRjyDRg9C60LDQt9Cw0L3QvdGL0YUg0LTQtdC50YHRgtCy0LjRgtC10LvRjNC90YvRhQ0KICDRjtGA0LjQtNC40YfQtdGB0LrQuNGFINGD0LLQtdC00L7Qv' .
        'NC70LXQvdC40Lkg0LjQu9C4INCw0LLRgtC+0YDRgdGC0LLQsCDQsiDRjdGC0L7QvCDQvNCw0YLQtdGA0LjQsNC70LUsINC40LvQuCDQsg0KICDQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40YUg0J/RgNCw0LLQvtCy0YvRhSDQo9Cy0LXQtNC+0LzQu9C10L3QuNGP0YUsINC+0YLQvtCx0YDQsNC20LDQtdC80YvRhQ0KICDQv9GA0L7QuNC30LLQtdC00LXQvdC40LXQvCwg0LjRhSDRgdC+0LTQtdGA0LbQsNGJ0LjQvDsg0LjQu9C4PC9saT4NCiAgPGxpPmMpINCX0LDQv9GA0LXRgiDQvdCwINC40YHQutCw0LbQtdC90LjQtSDQv9GA0L7QuNGB0YXQvtC20LTQtdC90LjRjyDRjdGC0L7Qs9C+INC80LDRgtC10YDQuNCw0LvQsCwg0LvQuNCx0L4NCiAg0YLRgNC10LHQvtCy0LDQvdC40LUg0Log0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QvdGL0Lwg0LLQtdGA0YHQuNGP0Lwg0YLQsNC60L7Qs9C+INC80LDRgtC10YDQuNCw0LvQsA0KICDRgdC+0LTQtdGA0LbQsNGC0Ywg0L/QvtC80LXRgtC60YMg0LIg0L3QsNC00LvQtdC20LDRidC10Lkg0YTQvtGA0LzQtSDQviDRgtC+0LwsINGH0YLQviDQvNCw0YLQtdGA0LjQsNC7DQogINC+0YLQu9C40YfQsNC10YLRgdGPINC+0YIg0L7RgNC40LPQuNC90LDQu9GM0L3QvtC5INCy0LXRgNGB0LjQuDsg0LjQu9C4PC9saT4NCiAgPGxp' .
        'PmQpINCe0LPRgNCw0L3QuNGH0LXQvdC40LUg0L3QsCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjQtSDQsiDRgNC10LrQu9Cw0LzQvdGL0YUg0YbQtdC70Y/RhSDQuNC80LXQvQ0KICDQstC70LDQtNC10LvRjNGG0LXQsiDQu9C40YbQtdC90LfQuNC4INC40LvQuCDQsNCy0YLQvtGA0L7QsiDQvNCw0YLQtdGA0LjQsNC70LA7INC40LvQuDwvbGk+DQogIDxsaT5lKSDQntGC0LrQsNC3INC/0YDQtdC00L7RgdGC0LDQstC70Y/RgtGMINC/0YDQsNCy0LAsINC/0YDQtdC00YPRgdC80L7RgtGA0LXQvdC90YvQtSDQt9Cw0LrQvtC90L7QvCDQvg0KICDRgtC+0LLQsNGA0L3Ri9GFINC30L3QsNC60LDRhSwg0LTQu9GPINC40YHQv9C+0LvRjNC30L7QstCw0L3QuNGPINC90LXQutC+0YLQvtGA0YvRhSDQuNC80LXQvSwg0YLQvtCy0LDRgNC90YvRhQ0KICDQt9C90LDQutC+0LIsINC30L3QsNC60L7QsiDQvtCx0YHQu9GD0LbQuNCy0LDQvdC40Y87INC40LvQuDwvbGk+DQogIDxsaT5mKSDQotGA0LXQsdC+0LLQsNC90LjQtSDQutC+0LzQv9C10L3RgdCw0YbQuNC4INCy0LvQsNC00LXQu9GM0YbQsNC8INC70LjRhtC10L3Qt9C40Lgg0Lgg0LDQstGC0L7RgNCw0LwNCiAg0Y3RgtC+0LPQviDQvNCw0YLQtdGA0LjQsNC70LAg0LrQtdC8LdC70LjQsdC+LCDQutGC0L4g0L/QtdGA0LXQtNC' .
        'w0LXRgiDQvNCw0YLQtdGA0LjQsNC7ICjQuNC70Lgg0LXQs9C+DQogINC80L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90L3Ri9C1INCy0LXRgNGB0LjQuCkg0YEg0LTQvtCz0L7QstC+0YDQvdGL0Lwg0L/RgNC40L3Rj9GC0LjQtdC8INC+0YLQstC10YLRgdGC0LLQtdC90L3QvtGB0YLQuA0KICDQv9C+0LvRg9GH0LDRgtC10LvRjyDQtNC70Y8g0LvRjtCx0L7QuSDQvtGC0LLQtdGC0YHRgtCy0LXQvdC90L7RgdGC0LgsINC60L7RgtC+0YDRg9GOINC00LDQvdC90L7QtSDQtNC+0LPQvtCy0L7RgNC90L7QtQ0KICDQv9GA0LjQvdGP0YLQuNC1INC90LXQv9C+0YHRgNC10LTRgdGC0LLQtdC90L3QviDQvdCw0LvQsNCz0LDQtdGCINC90LAg0LLQu9Cw0LTQtdC70YzRhtC10LIg0LvQuNGG0LXQvdC30LjQuCDQuA0KICDQsNCy0YLQvtGA0L7Qsi48L2xpPg0KPC91bD4NCjxwPtCS0YHQtSDQvtGB0YLQsNC70YzQvdGL0LUg0L3QtdGA0LDQt9GA0LXRiNC10L3QvdGL0LUg0LTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvQtSDRg9GB0LvQvtCy0LjRjyDRgdGH0LjRgtCw0Y7RgtGB0Y8NCuKAnNC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LzQuCDQt9Cw0L/RgNC10YLQsNC80LjigJ0g0L/QviDRgdC80YvRgdC70YMg0YDQsNC30LTQtdC70LAgMTAuINCV0YHQu9C4INCf0YDQvtCz0YDQsN' .
        'C80LzQsCwNCtC60LDQuiDQstGLINC10LUg0L/QvtC70YPRh9C40LvQuCwg0LjQu9C4INC70Y7QsdGD0Y4g0LXQtSDRh9Cw0YHRgtGMLCDRgdC+0LTQtdGA0LbQuNGCINGD0LLQtdC00L7QvNC70LXQvdC40LUg0L4NCtGC0L7QvCwg0YfRgtC+INC+0L3QsCDRg9C/0YDQsNCy0LvRj9C10YLRgdGPINCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC10Lkg0L3QsNGA0Y/QtNGDINGBINGC0LXRgNC80LjQvdC+0LwsDQrQutC+0YLQvtGA0YvQuSDQv9GA0LXQtNGB0YLQsNCy0LvRj9C10YIg0YHQvtCx0L7QuSDQtNCw0LvRjNC90LXQudGI0LXQtSDQvtCz0YDQsNC90LjRh9C10L3QuNC1LCDQstGLINC80L7QttC10YLQtQ0K0YPQtNCw0LvQuNGC0Ywg0Y3RgtC+0YIg0YLQtdGA0LzQuNC9LiDQldGB0LvQuCDQtNC+0LrRg9C80LXQvdGCINC70LjRhtC10L3Qt9C40Lgg0YHQvtC00LXRgNC20LjRgg0K0LTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvQtSDQt9Cw0L/RgNC10YLRiywg0L3QviDQtNC+0L/Rg9GB0LrQsNC10YIg0YDQtdC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC40LUg0LjQu9C4DQrQv9C10YDQtdC00LDRh9GDINCyINGB0L7QvtGC0LLQtdGC0YHRgtCy0LjQuCDRgSDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQtdC5LCDRgtC+INCy0Ysg0LzQvtC20LXRgtC1INC00' .
        'L7QsdCw0LLQuNGC0YwNCtC6INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QvNGDINC/0YDQvtC40LfQstC10LTQtdC90LjRjiDQvNCw0YLQtdGA0LjQsNC7LCDQt9Cw0YnQuNGJ0LXQvdC90YvQuSDRg9GB0LvQvtCy0LjRj9C80LgNCtGC0L7Qs9C+INC70LjRhtC10L3Qt9C40L7QvdC90L7Qs9C+INC00L7QutGD0LzQtdC90YLQsCwg0L/RgNC4INGD0YHQu9C+0LLQuNC4LCDRh9GC0L4g0LTQsNC70YzQvdC10LnRiNC10LUNCtC+0LPRgNCw0L3QuNGH0LXQvdC40LUg0L3QtSDRgdC+0YXRgNCw0L3Rj9C10YLRgdGPINC/0YDQuCDRgtCw0LrQvtC8INGA0LXQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QuNC4INC40LvQuA0K0L/QtdGA0LXQtNCw0YfQtS48L3A+DQo8cD7QldGB0LvQuCDQstGLINC00L7QsdCw0LLQu9GP0LXRgtC1INGD0YHQu9C+0LLQuNGPINCyINC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUg0LINCtGB0L7QvtGC0LLQtdGC0YHRgtCy0LjQuCDRgSDRjdGC0LjQvCDRgNCw0LfQtNC10LvQvtC8LCDRgtC+INCy0Ysg0LTQvtC70LbQvdGLINC/0L7QvNC10YHRgtC40YLRjCDQsg0K0YHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNGFINC40YHRhdC+0LTQvdGL0YUg0YTQsNC50LvQsNGFINGD0YLQstC10YDQ' .
        'ttC00LXQvdC40LUg0LTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvRhQ0K0YPRgdC70L7QstC40LksINC60L7RgtC+0YDRi9C1INC/0YDQuNC80LXQvdGP0Y7RgtGB0Y8g0Log0Y3RgtC40Lwg0YTQsNC50LvQsNC8LCDQuNC70Lgg0YPQstC10LTQvtC80LvQtdC90LjQtSDQvg0K0YLQvtC8LCDQs9C00LUg0L3QsNC50YLQuCDQtNCw0L3QvdGL0LUg0YPRgdC70L7QstC40Y8uPC9wPg0KPHA+0JTQvtC/0L7Qu9C90LjRgtC10LvRjNC90YvQtSDRg9GB0LvQvtCy0LjRjywg0YDQsNC30YDQtdGI0LXQvdC90YvQtSDQuNC70Lgg0L3QtdGA0LDQt9GA0LXRiNC10L3QvdGL0LUsINC80L7Qs9GD0YINCtCx0YvRgtGMINGD0YHRgtCw0L3QvtCy0LvQtdC90Ysg0LIg0LLQuNC00LUg0L7RgtC00LXQu9GM0L3QvtC5INC70LjRhtC10L3Qt9C40LgsINC40LvQuCDRg9GB0YLQsNC90L7QstC70LXQvdGLINC60LDQug0K0LjRgdC60LvRjtGH0LXQvdC40Y87INCy0YvRiNC10L/QtdGA0LXRh9C40YHQu9C10L3QvdGL0LUg0YLRgNC10LHQvtCy0LDQvdC40Y8g0L/RgNC40LzQtdC90Y/RjtGC0YHRjyDQsiDQu9GO0LHQvtC8DQrRgdC70YPRh9Cw0LUuPC9wPg0KPGgzPjguINCf0YDQtdC60YDQsNGJ0LXQvdC40LUg0LTQtdC50YHRgtCy0LjRjy48L2gzPg0KPHA+0JLRiyDQvdC1INC80L7QttC10YL' .
        'QtSDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90Y/RgtGMINC40LvQuCDQvNC+0LTQuNGE0LjRhtC40YDQvtCy0LDRgtGMINC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtQ0K0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDQt9CwINC40YHQutC70Y7Rh9C10L3QuNC10Lwg0YHQu9GD0YfQsNC10LIsINC+0LPQvtCy0L7RgNC10L3QvdGL0YUg0LIg0JTQsNC90L3QvtC5DQrQu9C40YbQtdC90LfQuNC4LiDQm9GO0LHQsNGPINC/0L7Qv9GL0YLQutCwINGA0LDRgdC/0YDQvtGB0YLRgNCw0L3QtdC90LjRjyDQuNC70Lgg0LzQvtC00LjRhNC40LrQsNGG0LjQuSDQvdCwINC40L3Ri9GFDQrRg9GB0LvQvtCy0LjRj9GFINC90LUg0LTQtdC50YHRgtCy0LjRgtC10LvRjNC90LAg0Lgg0LDQstGC0L7QvNCw0YLQuNGH0LXRgdC60Lgg0LvQuNGI0LDQtdGCINCy0LDRgSDQv9GA0LDQsg0K0YHQvtCz0LvQsNGB0L3QviDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCAo0LLQutC70Y7Rh9Cw0Y8g0LvRjtCx0YvQtSDQv9Cw0YLQtdC90YLRiywg0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90L3Ri9C1DQrRgdC+0LPQu9Cw0YHQvdC+INGC0YDQtdGC0YzQtdC80YMg0L/Rg9C90LrRgtGDINGA0LDQt9C00LXQu9CwIDExKS48L3A+DQo8cD7QntC00L3QsNC60L4sINC10YHQu9C4INCy0Ysg0L' .
        '/RgNC10LrRgNCw0YnQsNC10YLQtSDQvdCw0YDRg9GI0LXQvdC40LUg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LgsINGC0L7Qs9C00LANCtCy0LDRiNCwINC70LjRhtC10L3Qt9C40Y8g0L7RgiDQutC+0L3QutGA0LXRgtC90L7Qs9C+INCy0LvQsNC00LXQu9GM0YbQsCDQsNCy0YLQvtGA0YHQutC40YUg0L/RgNCw0LINCtCy0L7RgdGB0YLQsNC90LDQstC70LjQstCw0LXRgtGB0Y8gKNCwKSDQstGA0LXQvNC10L3QvdC+LCDQtNC+INGC0LXRhSDQv9C+0YAsINC/0L7QutCwINC/0YDQsNCy0L7QvtCx0LvQsNC00LDRgtC10LvRjA0K0Y/QstC90L4g0Lgg0L7QutC+0L3Rh9Cw0YLQtdC70YzQvdC+INC/0YDQtdC60YDQsNGJ0LDQtdGCINGB0LLQvtGOINC70LjRhtC10L3Qt9C40Y4sINC4ICjQsSkg0L/QvtGB0YLQvtGP0L3QvdC+LA0K0LXRgdC70Lgg0L/RgNCw0LLQvtC+0LHQu9Cw0LTQsNGC0LXQu9GMINC90LUg0YPQstC10LTQvtC80LjRgiDQstCw0YEg0L4g0L3QsNGA0YPRiNC10L3QuNC4INGBINC/0L7QvNC+0YnRjNGODQrQvdCw0LTQu9C10LbQsNGJ0LjRhSDRgdGA0LXQtNGB0YLQsiDQtNC+IDYwINC00L3QtdC5INC/0L7RgdC70LUg0L/RgNC10LrRgNCw0YnQtdC90LjRjyDQvdCw0YDRg9GI0LXQvdC40LkuPC9wPg0KPHA+0JrRgNC+0LzQtSDRgtC+0LPQviwg0' .
        'LLQsNGI0LAg0LvQuNGG0LXQvdC30LjRjyDQvtGCINC60L7QvdC60YDQtdGC0L3QvtCz0L4g0LLQu9Cw0LTQtdC70YzRhtCwINCw0LLRgtC+0YDRgdC60LjRhQ0K0L/RgNCw0LIg0LLQvtGB0YHRgtCw0L3QsNCy0LvQuNCy0LDQtdGC0YHRjyDQvdCwINC/0L7RgdGC0L7Rj9C90L3QvtC5INC+0YHQvdC+0LLQtSwg0LXRgdC70Lgg0LLQu9Cw0LTQtdC70LXRhg0K0LDQstGC0L7RgNGB0LrQuNGFINC/0YDQsNCyINGD0LLQtdC00L7QvNC70Y/QtdGCINCy0LDRgSDQviDQvdCw0YDRg9GI0LXQvdC40Lgg0YEg0L/QvtC80L7RidGM0Y4g0L3QsNC00LvQtdC20LDRidC40YUNCtGB0YDQtdC00YHRgtCyINC4INGN0YLQviDQv9C10YDQstGL0Lkg0YDQsNC3LCDQutC+0LPQtNCwINCy0Ysg0L/QvtC70YPRh9C40LvQuCDRg9Cy0LXQtNC+0LzQu9C10L3QuNC1INC+DQrQvdCw0YDRg9GI0LXQvdC40Lgg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LggKNC00LvRjyDQu9GO0LHQvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPKSDQvtGCINGN0YLQvtCz0L4NCtCy0LvQsNC00LXQu9GM0YbQsCDQsNCy0YLQvtGA0YHQutC40YUg0L/RgNCw0LIg0Lgg0YPRgdGC0YDQsNC90Y/QtdGC0LUg0L3QsNGA0YPRiNC10L3QuNC1INCyINGC0LXRh9C10L3QuNC1IDMwINC00L3QtdC5DQrQv9C+' .
        '0YHQu9C1INC/0L7Qu9GD0YfQtdC90LjRjyDRg9Cy0LXQtNC+0LzQu9C10L3QuNGPLjwvcD4NCjxwPtCb0LjRiNC10L3QuNC1INCy0LDRgSDQv9GA0LDQsiDRgdC+0LPQu9Cw0YHQvdC+INC00LDQvdC90L7QvNGDINGA0LDQt9C00LXQu9GDINC90LUg0LvQuNGI0LDQtdGCINC/0YDQsNCyINC70LjRhiwNCtC60L7RgtC+0YDRi9C1INC/0L7Qu9GD0YfQuNC70Lgg0LrQvtC/0LjQuCDQuNC70Lgg0L/RgNCw0LLQsCDQvtGCINCy0LDRgSDRgdC+0LPQu9Cw0YHQvdC+INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4Lg0K0JXRgdC70Lgg0LLQsNGI0Lgg0L/RgNCw0LLQsCDQsdGL0LvQuCDQv9GA0LjQvtGB0YLQsNC90L7QstC70LXQvdGLINC4INC90LUg0LLQvtGB0YHRgtCw0L3QvtCy0LvQtdC90Ysg0L3QsA0K0L/QvtGB0YLQvtGP0L3QvdC+0Lkg0L7RgdC90L7QstC1LCDRgtC+INCy0Ysg0L3QtSDQvNC+0LbQtdGC0LUg0L/QvtC70YPRh9C40YLRjCDQvdC+0LLRg9GOINC70LjRhtC10L3Qt9C40Y4g0L3QsCDRgtC+0YINCtC20LUg0LzQsNGC0LXRgNC40LDQuyDQsiDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Lgg0YEg0YDQsNC30LTQtdC70L7QvCAxMC48L3A+DQo8aDM+OS4g0KHQvtCz0LvQsNGB0LjQtSDQvdC1INGC0YDQtdCx0YPQtdGC0YHRjyDQtNC70Y8g0LLQu9Cw0LT' .
        'QtdC90LjRjyDQutC+0L/QuNC10LkuPC9oMz4NCjxwPtCS0Ysg0L3QtSDQvtCx0Y/Qt9Cw0L3RiyDRgdC+0LPQu9Cw0YjQsNGC0YzRgdGPINGBINCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC10LksINGH0YLQvtCx0Ysg0L/QvtC70YPRh9C40YLRjA0K0LjQu9C4INC30LDQv9GD0YHRgtC40YLRjCDQutC+0L/QuNGOINCf0YDQvtCz0YDQsNC80LzRiy4g0JIg0LTQvtC/0L7Qu9C90LXQvdC40LgsINGA0LDRgdC/0YDQvtGB0YLRgNCw0L3QtdC90LjQtQ0K0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPLCDQv9GA0L7QuNGB0YXQvtC00Y/RidC10LUg0LjRgdC60LvRjtGH0LjRgtC10LvRjNC90L4g0LrQsNC6DQrRgdC70LXQtNGB0YLQstC40LUg0LjRgdC/0L7Qu9GM0LfQvtCy0LDQvdC40Y8g0L/QvtC70YPRh9C10L3QuNGPINC60L7Qv9C40Y4g0L/QvtGB0YDQtdC00YHRgtCy0L7QvCDQv9C40YDQuNC90LPQvtCy0L7QuQ0K0YHQtdGC0Lgg0YLQsNC60LbQtSDQvdC1INGC0YDQtdCx0YPQtdGCINC/0YDQuNC90Y/RgtC40Y8uINCe0LTQvdCw0LrQviwg0YLQvtC70YzQutC+INCU0LDQvdC90LDRjyDQu9C40YbQtdC90LfQuNGPDQrQtNCw0LXRgiDQstCw0Lwg0L/RgNCw0LLQsCDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90L' .
        'XQvdC40Y8g0LjQu9C4INC80L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90LjRjyDQu9GO0LHRi9GFDQrQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdGL0YUg0YDQsNCx0L7Rgi4g0K3RgtC4INC00LXQudGB0YLQstC40Y8g0L3QsNGA0YPRiNCw0Y7RgiDQsNCy0YLQvtGA0YHQutC+0LUg0L/RgNCw0LLQviwNCtC10YHQu9C4INCy0Ysg0L3QtSDRgdC+0LPQu9Cw0YjQsNC10YLQtdGB0Ywg0YEg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LXQuS4g0J/QvtGN0YLQvtC80YMsINC80L7QtNC40YTQuNGG0LjRgNGD0Y8NCtC40LvQuCDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90Y/RjyDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDQstGLINC/0L7QtNGC0LLQtdGA0LbQtNCw0LXRgtC1DQrRgdCy0L7QtSDRgdC+0LPQu9Cw0YHQuNC1INGBINCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC10LkuPC9wPg0KPGgzPjEwLiDQkNCy0YLQvtC80LDRgtC40YfQtdGB0LrQvtC1INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC40LUg0L/QvtGB0LvQtdC00YPRjtGJ0LjRhQ0K0L/QvtC70YPRh9Cw0YLQtdC70LXQuS48L2gzPg0KPHA+0JrQsNC20LTRi9C5INGA0LDQtywg0LrQvtCz0LTQsCDQstGLINC/0LXRgNC10LTQsNC10YLQtSDQu' .
        '9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LA0K0L/QvtC70YPRh9Cw0YLQtdC70Ywg0LDQstGC0L7QvNCw0YLQuNGH0LXRgdC60Lgg0L/QvtC70YPRh9Cw0YIg0LvQuNGG0LXQvdC30LjRjiDQvtGCINC/0LXRgNCy0L7QvdCw0YfQsNC70YzQvdC+0LPQvg0K0LLQu9Cw0LTQtdC70YzRhtCwINC70LjRhtC10L3Qt9C40Lgg0L3QsCDQt9Cw0L/Rg9GB0LosINC80L7QtNC40YTQuNGG0LjRgNC+0LLQsNC90LjQtSDQuCDRgNCw0YHQv9GA0L7RgdGC0YDQsNC90LXQvdC40LUNCtC/0YDQvtC40LfQstC10LTQtdC90LjRjywg0LLRi9C/0YPRidC10L3QvdC+0LPQviDQv9C+INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4LiDQktGLINC90LUg0L3QtdGB0LXRgtC1DQrQvtGC0LLQtdGC0YHRgtCy0LXQvdC90L7RgdGC0Ywg0LfQsCDRgdC+0LHQu9GO0LTQtdC90LjQtSDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDRgtGA0LXRgtGM0LjQvNC4DQrQu9C40YbQsNC80LguPC9wPg0KPHA+4oCc0K7RgNC40LTQuNGH0LXRgdC60LDRjyDRgtGA0LDQvdC30LDQutGG0LjRj+KAnSAtINGN0YLQviDRgtGA0LDQvdC30LDQutGG0LjRjywg0L/QtdGA0LXQtNCw0Y7RidCw0Y8g0LrQvtC90YLRgNC+0LvRjA0K0L7RgNCz0LDQvdC40LfQ' .
        'sNGG0LjQuCwg0LjQu9C4INC/0YDQsNC60YLQuNGH0LXRgdC60Lgg0LLRgdC1INCw0LrRgtC40LLRiyDRgtCw0LrQvtCy0L7QuSwg0LjQu9C4INGA0LDQt9C00LXQu9C10L3QuNC1DQrQvtGA0LPQsNC90LjQt9Cw0YbQuNC4LCDQuNC70Lgg0YHQu9C40Y/QvdC40LUg0L7RgNCz0LDQvdC40LfQsNGG0LjQuS4g0JXRgdC70Lgg0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdC10L3QuNC1DQrQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LPQviDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8g0Y/QstC70Y/QtdGC0YHRjyDRgNC10LfRg9C70YzRgtCw0YLQvtC8INGO0YDQuNC00LjRh9C10YHQutC+0LkNCtGC0YDQsNC90LfQsNC60YbQuNC4LCDRgtC+INC60LDQttC00LDRjyDRgdGC0L7RgNC+0L3QsCDRgtGA0LDQvdC30LDQutGG0LjQuCwg0LrQvtGC0L7RgNCw0Y8g0L/QvtC70YPRh9C40LvQsCDQutC+0L/QuNGODQrQv9GA0L7QuNC30LLQtdC00LXQvdC40Y8sINGC0LDQutC20LUg0L/QvtC70YPRh9Cw0LXRgiDQstGB0LUg0LvQuNGG0LXQvdC30LjQuCDQvdCwINC/0YDQvtC40LfQstC10LTQtdC90LjQtSwNCtC60L7RgtC+0YDRi9C1INC/0YDQtdC00YjQtdGB0YLQstC10L3QvdC40Log0YHRgtC+0YDQvtC90Ysg0LjQvNC10Lsg0LjQu9C4INC80L7QsyDQstGL0LTQsNGC0Ywg0YH' .
        'QvtCz0LvQsNGB0L3Qvg0K0L/RgNC10LTRi9C00YPRidC10LzRgyDRgNCw0LfQtNC10LvRgywg0LAg0YLQsNC60LbQtSDQv9GA0LDQstC+INCy0LvQsNC00LXQvdC40Y8g0KHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQuNC8DQrQuNGB0YXQvtC00L3Ri9C8INC60L7QtNC+0Lwg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINC+0YIg0L/RgNC10LTRiNC10YHRgtCy0LXQvdC90LjQutCwLCDQtdGB0LvQuCDQvtC9INC+0LHQu9Cw0LTQsNC7DQrQodC+0L7RgtCy0LXRgtGB0YLQstGD0Y7RidC40Lwg0LjRgdGF0L7QtNC90YvQvCDQutC+0LTQvtC8LCDQuNC70Lgg0LzQvtCzINC10LPQviDQv9C+0LvRg9GH0LjRgtGMINC/0YDQuA0K0YHQvtC+0YLQstC10YLRgdGC0LLRg9GO0YnQtdC8INC30LDQv9GA0L7RgdC1LjwvcD4NCjxwPtCS0Ysg0L3QtSDQvNC+0LbQtdGC0LUg0L3QsNC70LDQs9Cw0YLRjCDQutCw0LrQuNC1LdC70LjQsdC+INC+0LPRgNCw0L3QuNGH0LXQvdC40Y8g0L3QsCDQvtGB0YPRidC10YHRgtCy0LvQtdC90LjQtQ0K0L/RgNCw0LIsINC/0YDQtdC00L7RgdGC0LDQstC70LXQvdC90YvRhSDQuNC70Lgg0L/QvtC00YLQstC10YDQttC00LXQvdC90YvRhSDRgdC+0LPQu9Cw0YHQvdC+INCU0LDQvdC90L7QuQ0K0LvQuNGG0LXQvdC30LjQuC4g0J3QsNC/0YDQuNC80L' .
        'XRgCwg0LXRgdC70Lgg0LLRiyDQvdC1INC80L7QttC10YLQtSDQvdCw0LvQsNCz0LDRgtGMINC70LjRhtC10L3Qt9C40L7QvdC90YvQtQ0K0YHQsdC+0YDRiywg0LDQstGC0L7RgNGB0LrQuNC5INCz0L7QvdC+0YDQsNGALCDQuNC70Lgg0LTRgNGD0LPQuNC1INCy0LjQtNGLINCy0YvQv9C70LDRgiDQt9CwINC+0YHRg9GJ0LXRgdGC0LLQu9C10L3QuNC1DQrQv9GA0LDQsiwg0L/RgNC10LTQvtGB0YLQsNCy0LvQtdC90L3Ri9GFINC/0L4g0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LgsINC4INCy0Ysg0L3QtSDQvNC+0LbQtdGC0LUNCtC40L3QuNGG0LjQuNGA0L7QstCw0YLRjCDRgdGD0LTQtdCx0L3Ri9C5INC/0YDQvtGG0LXRgdGBICjQstC60LvRjtGH0LDRjyDQstGB0YLRgNC10YfQvdGL0Lkg0LjRgdC6INC40LvQuA0K0LLRgdGC0YDQtdGH0L3Ri9C5INC40YHQuiDQsiDRgdGD0LTQtdCx0L3QvtC8INC/0YDQvtGG0LXRgdGB0LUpLCDRg9GC0LLQtdGA0LbQtNCw0Y8sINGH0YLQviDQu9GO0LHQvtC1DQrQv9Cw0YLQtdC90YLQvdC+0LUg0YLRgNC10LHQvtCy0LDQvdC40LUg0L3QsNGA0YPRiNC10L3QviDQv9GD0YLQtdC8INGB0L7Qt9C00LDQvdC40Y8sINC40YHQv9C+0LvRjNC30L7QstCw0L3QuNGPLA0K0L/RgNC+0LTQsNC20LgsINC/0YDQtdC00LvQvtC20LXQv' .
        'dC40Y8g0Log0L/RgNC+0LTQsNC20LUsINC40LvQuCDQuNC80L/QvtGA0YLQsCDQn9GA0L7Qs9GA0LDQvNC80Ysg0LjQu9C4INC70Y7QsdC+0LkNCtC10LUg0YfQsNGB0YLQuC48L3A+DQo8aDM+MTEuINCf0LDRgtC10L3RgtGLLjwvaDM+DQo8cD7igJzQktC60LvQsNC00YfQuNC64oCdINGP0LLQu9GP0LXRgtGB0Y8g0LLQu9Cw0LTQtdC70YzRhtC10Lwg0LDQstGC0L7RgNGB0LrQuNGFINC/0YDQsNCyLCDRgNCw0LfRgNC10YjQsNGO0YnQuNC8DQrQuNGB0L/QvtC70YzQt9C+0LLQsNC90LjQtSDQn9GA0L7Qs9GA0LDQvNC80Ysg0YHQvtCz0LvQsNGB0L3QviDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQuNC70LgNCtC/0YDQvtC40LfQstC10LTQtdC90LjRjywg0L3QsCDQutC+0YLQvtGA0L7QvCDQvtGB0L3QvtCy0LDQvdCwINC/0YDQvtCz0YDQsNC80LzQsC4g0J/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LA0K0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC1INGC0LDQutC40Lwg0L7QsdGA0LDQt9C+0LwsINC90LDQt9GL0LLQsNC10YLRgdGPIOKAnNCy0LXRgNGB0LjQtdC5DQrQstC60LvQsNC00YfQuNC60LDigJ0uPC9wPg0KPHA+4oCc0J7RgdC90L7QstC90YvQtSDQv9Cw0YLQtdC90YLQvdGL0LUg0YLRgNC10LHQvtCy0LDQvdC40Y/igJ0g0LLQutC70LDQ' .
        'tNGH0LjQutCwINGN0YLQviDQstGB0LUg0L/QsNGC0LXQvdGC0L3Ri9C1DQrQv9GA0LXRgtC10L3Qt9C40LgsINC/0YDQuNC90LDQtNC70LXQttCw0YnQuNC1INC40LvQuCDQutC+0L3RgtGA0L7Qu9C40YDRg9C10LzRi9C1INCy0LrQu9Cw0LTRh9C40LrQvtC8LCDQuNC70Lgg0YPQttC1DQrQv9GA0LjQvtCx0YDQtdGC0LXQvdC90YvQtSwg0LjQu9C4INC90LDQvNC10YfQtdC90L3Ri9C1INC00LvRjyDQv9GA0LjQvtCx0YDQtdGC0LXQvdC40Y8sINC60L7RgtC+0YDRi9C1INCx0YPQtNGD0YINCtC90LDRgNGD0YjQtdC90Ysg0YLQtdC8INC40LvQuCDQuNC90YvQvCDQvtCx0YDQsNC30L7QvCwg0LTQvtC/0YPRgdC60LDRjtGJ0LjQvNGB0Y8g0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LXQuSwNCtCy0LrQu9GO0YfQsNGPINGB0L7Qt9C00LDQvdC40LUsINC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC1INC40LvQuCDQv9GA0L7QtNCw0LbRgyDQstC10YDRgdC40Lgg0LLQutC70LDQtNGH0LjQutCwLCDQvdC+DQrQvdC1INCy0LrQu9GO0YfQsNC10YIg0LIg0YHQtdCx0Y8g0YLRgNC10LHQvtCy0LDQvdC40Y8sINC60L7RgtC+0YDRi9C1INCx0YPQtNGD0YIg0L3QsNGA0YPRiNC10L3RiyDRgtC+0LvRjNC60L4g0LINCtGE0L7RgNC80LUg0YHQvtCy0L7QutGD0L/QvdC+0YH' .
        'RgtC4INCx0YPQtNGD0YnQuNGFINC40LfQvNC10L3QtdC90LjQuSDQstC10YDRgdC40Lkg0LLQutC70LDQtNGH0LjQutCwLiDQlNC70Y8g0YbQtdC70LXQuQ0K0LTQsNC90L3QvtCz0L4g0L7Qv9GA0LXQtNC10LvQtdC90LjRjywg4oCc0LrQvtC90YLRgNC+0LvRjOKAnSDQstC60LvRjtGH0LDQtdGCINCyINGB0LXQsdGPINC/0YDQsNCy0L4g0LLRi9C00LDQstCw0YLRjA0K0L/QsNGC0LXQvdGC0L3Ri9C1INGB0YPQsdC70LjRhtC10L3Qt9C40Lgg0LIg0YHQvtC+0YLQstC10YLRgdGC0LLQuNC4INGBINGC0YDQtdCx0L7QstCw0L3QuNGP0LzQuCDQlNCw0L3QvdC+0LkNCtC70LjRhtC10L3Qt9C40LguPC9wPg0KPHA+0JrQsNC20LTRi9C5INCy0LrQu9Cw0LTRh9C40Log0L/RgNC10LTQvtGB0YLQsNCy0LvRj9C10YIg0LLQsNC8INC90LXRjdC60YHQutC70Y7Qt9C40LLQvdGD0Y4sINCy0YHQtdC80LjRgNC90YPRjiwNCtCx0LXQt9Cy0L7Qt9C80LXQt9C00L3Rg9GOINC70LjRhtC10L3Qt9C40Y4g0L3QsCDQv9Cw0YLQtdC90YIsINGB0L7Qs9C70LDRgdC90L4g0L7RgdC90L7QstC90YvQvCDQv9Cw0YLQtdC90YLQvdGL0LwNCtGC0YDQtdCx0L7QstCw0L3QuNGP0Lwg0LLQutC70LDQtNGH0LjQutCwLCDQvdCwINC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC1LCDQv9GA0L7QtN' .
        'Cw0LbRgywg0L/RgNC10LTQu9C+0LbQtdC90LjRjyDQtNC70Y8NCtC/0YDQvtC00LDQttC4LCDQuNC80L/QvtGA0YLQuNGA0L7QstCw0L3QuNC1INC4INC30LDQv9GD0YHQuiwg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0L3QuNC1INC4DQrRgNCw0YHQv9GA0L7RgdGC0YDQsNC90LXQvdC40LUg0YHQvtC00LXRgNC20LjQvNC+0LPQviDQstC10YDRgdC40Lgg0LLQutC70LDQtNGH0LjQutCwLjwvcD4NCjxwPtCSINGB0LvQtdC00YPRjtGJ0LjRhSDRgtGA0LXRhSDQsNCx0LfQsNGG0LDRhSwg4oCc0L/QsNGC0LXQvdGC0L3QsNGPINC70LjRhtC10L3Qt9C40Y/igJ0g0L7Qt9C90LDRh9Cw0LXRgiDQu9GO0LHQvtC1DQrQv9GA0Y/QvNC+0LUg0YHQvtCz0LvQsNGI0LXQvdC40LUg0LjQu9C4INC+0LHRj9C30LDRgtC10LvRjNGB0YLQstC+INC90LUg0L/RgNC40LzQtdC90Y/RgtGMINC/0LDRgtC10L3Rgg0KKNC90LDQv9GA0LjQvNC10YAsINGA0LDQt9GA0LXRiNC10L3QuNC1INC90LAg0LjRgdC/0L7Qu9GM0LfQvtCy0LDQvdC40LUg0L/QsNGC0LXQvdGC0L3QvtCz0L4g0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPDQrQuNC70Lgg0L7QsdGP0LfQsNGC0LXQu9GM0YHRgtCy0L4g0L3QtSDQv9C+0LTQsNCy0LDRgtGMINCyINGB0YPQtCDQt9CwINC90LDRgNGD0YjQtdC90LjQtSDQv' .
        '9Cw0YLQtdC90YLQsCkuDQrigJzQktGL0LTQsNGC0YzigJ0g0YLQsNC60YPRjiDQv9Cw0YLQtdC90YLQvdGD0Y4g0LvQuNGG0LXQvdC30LjRjiDQvtC00L3QvtC5INC40Lcg0YHRgtC+0YDQvtC9INC+0LfQvdCw0YfQsNC10YINCtC30LDQutC70Y7Rh9C40YLRjCDRgtCw0LrQvtC1INGB0L7Qs9C70LDRiNC10L3QuNC1INC40LvQuCDQvtCx0Y/Qt9Cw0YLQtdC70YzRgdGC0LLQviDQvdC1INC/0YDQuNC80LXQvdGP0YLRjCDQv9Cw0YLQtdC90YINCtC/0YDQvtGC0LjQsiDRgdGC0L7RgNC+0L3Riy48L3A+DQo8cD7QldGB0LvQuCDQstGLINC/0LXRgNC10LTQsNC10YLQtSDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDRgdC+0LfQvdCw0YLQtdC70YzQvdC+DQrQvtGB0L3QvtCy0YvQstCw0Y/RgdGMINC90LAg0L/QsNGC0LXQvdGC0L3QvtC5INC70LjRhtC10L3Qt9C40LgsINC4INCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtA0K0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNGPINC90LUg0LTQvtGB0YLRg9C/0LXQvSDQvdC40LrQvtC80YMg0LTQu9GPINCx0LXRgdC/0LvQsNGC0L3QvtCz0L4g0LrQvtC/0LjRgNC+0LLQsNC90LjRjyDQuCDQsg0K0YHQvtC+0YLQstC10YLRgdGC' .
        '0LLQuNC4INGBINGD0YHQu9C+0LLQuNGP0LzQuCDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCwg0YfQtdGA0LXQtyDQvtCx0YnQtdC00L7RgdGC0YPQv9C90YvQuQ0K0YHQtdGC0LXQstC+0Lkg0YHQtdGA0LLQtdGAINC40LvQuCDQtNGA0YPQs9C40LzQuCDQu9C10LPQutC+0LTQvtGB0YLRg9C/0L3Ri9C80Lgg0YHRgNC10LTRgdGC0LLQsNC80LgsINGC0L4g0LLRiw0K0LTQvtC70LbQvdGLINC40LvQuCAoMSkg0YHQtNC10LvQsNGC0Ywg0YLQsNC6LCDRh9GC0L7QsdGLINCh0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQuSDQuNGB0YXQvtC00L3Ri9C5INC60L7QtA0K0YHRgtCw0Lsg0LTQvtGB0YLRg9C/0LXQvSwg0LjQu9C4ICgyKSDQtNC+0LPQvtCy0L7RgNC40YLRjNGB0Y8g0LvQuNGI0LjRgtGMINGB0LXQsdGPINCy0YvQs9C+0LTRiyDQuNC3DQrQv9Cw0YLQtdC90YLQvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQvdCwINC00LDQvdC90L7QtSDQutC+0L3QutGA0LXRgtC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUsINC40LvQuCAoMykNCtC/0YDQuNC90Y/RgtGMINC80LXRgNGLLCDQsiDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Lgg0YEg0YLRgNC10LHQvtCy0LDQvdC40Y/QvNC4INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4INC+DQrRgNCw0YH' .
        'RiNC40YDQtdC90LjQuCDQv9Cw0YLQtdC90YLQvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQtNC70Y8g0L/QvtGB0LvQtdC00YPRjtGJ0LjRhSDQv9C+0LvRg9GH0LDRgtC10LvQtdC5Lg0K4oCc0KHQvtC30L3QsNGC0LXQu9GM0L3QviDQvtGB0L3QvtCy0YvQstCw0Y/RgdGM4oCdINC+0LfQvdCw0YfQsNC10YIsINGH0YLQviDRgyDQstCw0YEg0LXRgdGC0Ywg0YTQsNC60YLQuNGH0LXRgdC60LjQtQ0K0LfQvdCw0L3QuNGPINGD0YHQu9C+0LLQuNC5INC/0LDRgtC10L3RgtC90L7QuSDQu9C40YbQtdC90LfQuNC4LCDQvdC+INC/0LXRgNC10LTQsNGH0LAg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtCz0L4NCtC/0YDQvtC40LfQstC10LTQtdC90LjRjyDQsiDRgdGC0YDQsNC90LUg0LjQu9C4INC40YHQv9C+0LvRjNC30L7QstCw0L3QuNC1INCy0LDRiNC10LPQviDQv9C+0LvRg9GH0LDRgtC10LvRjw0K0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC5INGA0LDQt9GA0LDQsdC+0YLQutC4INCyINGB0YLRgNCw0L3QtSwg0L3QsNGA0YPRiNC40YIg0L7QtNC40L0g0LjQu9C4INCx0L7Qu9C10LUNCtC40LTQtdC90YLQuNGE0LjRhtC40YDRg9C10LzRi9GFINC/0LDRgtC10L3RgtC+0LIg0LIg0Y3RgtC+0Lkg0YHRgtGA0LDQvdC1INC4INC60L7RgtC+0YDRi9C5INCy0Y' .
        'sg0LjQvNC10LXRgtC1DQrQvtGB0L3QvtCy0LDQvdC40Y8g0YHRh9C40YLQsNGC0Ywg0LTQtdC50YHRgtCy0LjRgtC10LvRjNC90YvQvC48L3A+DQo8cD7QldGB0LvQuCDQsiDRgdC+0L7RgtCy0LXRgtGB0YLQstC40Lgg0YEg0LjQu9C4INCyINGB0LLRj9C30Lgg0YEg0LrQvtC90LrRgNC10YLQvdC+0Lkg0YHQtNC10LvQutC+0Lkg0LjQu9C4DQrRgdC+0LPQu9Cw0YjQtdC90LjQtdC8INCy0Ysg0L/QtdGA0LXQtNCw0LXRgtC1LCDQuNC70Lgg0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdGP0LXRgtC1INC/0YPRgtC10Lwg0L3QsNC60LvQsNC00LrQuA0K0L/QtdGA0LXQtNCw0Ycg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC1INC/0YDQvtC40LfQstC10LTQtdC90LjQtSwg0LTQsNCy0LDRjyDQuNC8INC/0YDQsNCy0L4NCtC40YHQv9C+0LvRjNC30L7QstCw0YLRjCwg0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdGP0YLRjCwg0LzQvtC00LjRhNC40YbQuNGA0L7QstCw0YLRjCDQuNC70Lgg0L/QtdGA0LXQtNCw0LLQsNGC0YwNCtC+0L/RgNC10LTQtdC70LXQvdC90YPRjiDQutC+0L/QuNGOINC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QuSDRgNCw0LfRgNCw0LHQvtGC0LrQuCwg0YLQviDQv9Cw0YLQtdC90YIg0LLRiw0K0L/RgNC10LTQvtGB0YLQsNCy0LvRj9C10YLQt' .
        'SDQsNCy0YLQvtC80LDRgtC40YfQtdGB0LrQuCDQvdCwINCy0YHQtdGFINC/0L7Qu9GD0YfQsNGC0LXQu9C10Lkg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtCz0L4NCtC/0YDQvtC40LfQstC10LTQtdC90LjRjyDQuCDQv9GA0L7QuNC30LLQtdC00LXQvdC40Lkg0L3QsCDQtdCz0L4g0L7RgdC90L7QstC1LjwvcD4NCjxwPtCf0LDRgtC10L3RgtC90LDRjyDQu9C40YbQtdC90LfQuNGPINGP0LLQu9GP0LXRgtGB0Y8gItC00LjRgdC60YDQuNC80LjQvdCw0YbQuNC+0L3QvdC+0LkiLCDQtdGB0LvQuCDQvtC90LAg0L3QtQ0K0L7Qv9C40YHRi9Cy0LDQtdGCINGB0LLQvtGOINGB0YTQtdGA0YMg0L/RgNC40LzQtdC90LXQvdC40Y8sINC30LDQv9GA0LXRidCw0LXRgiDQvtGB0YPRidC10YHRgtCy0LvQtdC90LjQtSDQuNC70LgNCtC+0LHRg9GB0LvQvtCy0LvQtdC90LAg0L3QtdC+0YHRg9GJ0LXRgdGC0LLQu9C10L3QuNC10Lwg0L7QtNC90L7Qs9C+INC40LvQuCDQsdC+0LvQtdC1INC/0YDQsNCyLCDQutC+0YLQvtGA0YvQtSDRj9Cy0L3Qvg0K0LLRi9C00LDRjtGC0YHRjyDRgdC+0LPQu9Cw0YHQvdC+INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4LiDQktGLINC90LUg0LzQvtC20LXRgtC1INC/0LXRgNC10LTQsNCy0LDRgtGMDQrQu9C40YbQtdC90LfQuNGA0L7Q' .
        'stCw0L3QvdC+0LUg0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LCDQtdGB0LvQuCDQstGLIC0g0L7QtNC90LAg0LjQtyDRgdGC0L7RgNC+0L0g0YHQvtCz0LvQsNGI0LXQvdC40Y8NCtGBINGC0YDQtdGC0YzQtdC5INGB0YLQvtGA0L7QvdC+0LksINC60L7RgtC+0YDQsNGPINC30LDQvdC40LzQsNC10YLRgdGPINC00LjRgdGC0YDQuNCx0YPRhtC40LXQuSDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4NCtC+0LHQtdGB0L/QtdGH0LXQvdC40Y8sINGB0L7Qs9C70LDRgdC90L4g0LrQvtGC0L7RgNC+0Lkg0LLRiyDQv9GA0L7QuNC30LLQvtC00LjRgtC1INCy0YvQv9C70LDRgtGDINGC0YDQtdGC0YzQtdC80YMNCtC70LjRhtGDINCyINC30LDQstC40YHQuNC80L7RgdGC0Lgg0L7RgiDQvtCx0YrQtdC80LAg0L7RgdGD0YnQtdGB0YLQstC70Y/QtdC80YvRhSDQv9C10YDQtdC00LDRhywg0Lgg0YHQvtCz0LvQsNGB0L3Qvg0K0LrQvtGC0L7RgNC+0Lkg0YLRgNC10YLRjNC1INC70LjRhtC+INCy0YvQtNCw0LXRgiwg0LvRjtCx0L7QuSDRgdGC0L7RgNC+0L3QtSwg0L/QvtC70YPRh9Cw0Y7RidC10LkNCtC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7QtSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LUg0L7RgiDQstCw0YEsINC00LjRgdC60YDQuNC80LjQvdCw0YbQuNC+0L3QvdGD0Y4' .
        'g0L/QsNGC0LXQvdGC0L3Rg9GODQrQu9C40YbQtdC90LfQuNGOICjQsCkg0LLQvNC10YHRgtC1INGBINC60L7Qv9C40Y/QvNC4INC70LjRhtC10L3Qt9C40YDQvtCy0LDQvdC90L7Qs9C+INC/0YDQvtC40LfQstC10LTQtdC90LjRjywNCtC/0LXRgNC10LTQsNC90L3Ri9C80Lgg0LLQsNC80LggKNC40LvQuCDQutC+0L/QuNGP0LzQuCwg0YHQtNC10LvQsNC90L3Ri9C80Lgg0YEg0Y3RgtC40YUg0LrQvtC/0LjQuSksINC40LvQuCAo0LEpDQrQstC80LXRgdGC0LUg0YEg0LrQvtC90LrRgNC10YLQvdGL0LzQuCDQv9GA0L7QtNGD0LrRgtCw0LzQuCDQuNC70Lgg0YHQsdC+0YDQutCw0LzQuCwg0YHQvtC00LXRgNC20LDRidC40LzQuA0K0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC1INC/0YDQvtC40LfQstC10LTQtdC90LjQtSwg0LIg0YHQu9GD0YfQsNC1INC10YHQu9C4INCy0Ysg0L3QtSDQstGB0YLRg9C/0LjQu9C4INCyDQrRgdC+0LPQu9Cw0YjQtdC90LjQtSDQuNC70Lgg0L/QsNGC0LXQvdGC0L3QsNGPINC70LjRhtC10L3Qt9C40Y8g0L3QtSDQv9GA0LXQtNC+0YHRgtCw0LLQu9C10L3QsCDQtNC+IDI4INC80LDRgNGC0LANCjIwMDcg0LPQvtC00LAuPC9wPg0KPHA+0J3QuNGH0YLQviDQsiDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQvdC1INC00L7Qu9' .
        'C20L3QviDRgtC+0LvQutC+0LLQsNGC0YzRgdGPINC60LDQuiDQuNGB0LrQu9GO0YfQtdC90LjQtQ0K0LjQu9C4INC+0LPRgNCw0L3QuNGH0LXQvdC40LUg0LvRjtCx0L7QuSDQv9C+0LTRgNCw0LfRg9C80LXQstCw0LXQvNC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQuNC70Lgg0LTRgNGD0LPQuNGFDQrRgdC/0L7RgdC+0LHQvtCyINC/0YDQvtGC0LjQstC+0LTQtdC50YHRgtCy0LjRjyDQvdCw0YDRg9GI0LXQvdC40Y4sINC60L7RgtC+0YDRi9C1INC40L3QsNGH0LUg0LzQvtCz0YPRgiDQsdGL0YLRjA0K0LTQvtGB0YLRg9C/0L3RiyDQtNC70Y8g0LLQsNGBINCyINGB0L7QvtGC0LLQtdGC0YHRgtCy0LjQuCDRgSDQv9GA0LjQvNC10L3QuNC80YvQvCDQv9Cw0YLQtdC90YLQvdGL0LwNCtC30LDQutC+0L3QvtC00LDRgtC10LvRjNGB0YLQstC+0LwuPC9wPg0KPGgzPjEyLiDQndC1INC+0YLQutCw0LfRi9Cy0LDRgtGMINCyINGB0LLQvtCx0L7QtNC1INC00YDRg9Cz0LjQvC48L2gzPg0KPHA+0JXRgdC70Lgg0YPRgdC70L7QstC40Y8g0L3QsNC70L7QttC10L3RiyDQvdCwINCy0LDRgSAo0L/QviDRgNC10YjQtdC90LjRjiDRgdGD0LTQsCwg0YHQvtCz0LvQsNGI0LXQvdC40LXQvCDQuNC70LgNCtC40L3QsNGH0LUpLCDQutC+0YLQvtGA0YvQtSDQv9GA0L7RgtC40LLQvtGA0LXRh' .
        '9Cw0YIg0YPRgdC70L7QstC40Y/QvCDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCwg0L7QvdC4INC90LUNCtC+0YHQstC+0LHQvtC20LTQsNGO0YIg0LLQsNGBINC+0YIg0YPRgdC70L7QstC40Lkg0JTQsNC90L3QvtC5INC70LjRhtC10L3Qt9C40LguINCV0YHQu9C4INCy0Ysg0L3QtSDQvNC+0LbQtdGC0LUNCtC/0LXRgNC10LTQsNGC0Ywg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3QvtC1INC/0YDQvtC40LfQstC10LTQtdC90LjQtSDRgtCw0LosINGH0YLQvtCx0Ysg0L7QtNC90L7QstGA0LXQvNC10L3QvdC+DQrRg9C00L7QstC70LXRgtCy0L7RgNC40YLRjCDRgtGA0LXQsdC+0LLQsNC90LjRj9C8INC4INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4INC4INCy0YHQtdC8INC00YDRg9Cz0LjQvA0K0L7QsdGP0LfQsNGC0LXQu9GM0YHRgtCy0LDQvCwg0LAg0LfQsNGC0LXQvCwg0LrQsNC6INGB0LvQtdC00YHRgtCy0LjQtSwg0LLRiyDQvdC1INC80L7QttC10YLQtSDQv9C10YDQtdC00LDQstCw0YLRjA0K0LXQtSDQstC+0L7QsdGJ0LUuINCd0LDQv9GA0LjQvNC10YAsINC10YHQu9C4INCy0Ysg0YHQvtCz0LvQsNGB0L3RiyDRgSDRg9GB0LvQvtCy0LjRj9C80LgsINC+0LHRj9C30YvQstCw0Y7RidC40LzQuA0K0LLQsNGBINGB0L7QsdC40YDQsNGC0Ywg' .
        '0LDQstGC0L7RgNGB0LrQuNC1INC+0YLRh9C40YHQu9C10L3QuNGPINC00LvRjyDQtNCw0LvRjNC90LXQudGI0LXQuSDQv9C10YDQtdC00LDRh9C4INC+0YIg0YLQtdGFLA0K0LrQvtC80YMg0LLRiyDQv9C10YDQtdC00LDQtdGC0LUg0J/RgNC+0LPRgNCw0LzQvNGDLCDQtdC00LjQvdGB0YLQstC10L3QvdGL0Lkg0YHQv9C+0YHQvtCxINGD0LTQvtCy0LvQtdGC0LLQvtGA0LjRgtGMDQrRjdGC0LjQvCDRg9GB0LvQvtCy0LjRj9C8INC4INCU0LDQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4INCx0YPQtNC10YIg0L/QvtC70L3QvtC1INCy0L7Qt9C00LXRgNC20LDQvdC40LUg0L7Rgg0K0L/QtdGA0LXQtNCw0YfQuCDQn9GA0L7Qs9GA0LDQvNC80YsuPC9wPg0KPGgzPjEzLiDQmNGB0L/QvtC70YzQt9C+0LLQsNC90LjQtSDRgdC+0LLQvNC10YHRgtC90L4g0YEg0KPQvdC40LLQtdGA0YHQsNC70YzQvdC+0Lkg0L7QsdGJ0LXRgdGC0LLQtdC90L3QvtC5DQrQu9C40YbQtdC90LfQuNC10LkgR05VINCQ0YTRhNC10YDQvi48L2gzPg0KPHA+0J3QtdGB0LzQvtGC0YDRjyDQvdCwINC70Y7QsdGL0LUg0LTRgNGD0LPQuNC1INC/0L7Qu9C+0LbQtdC90LjRjyDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCwg0LLRiyDQuNC80LXQtdGC0LUNCtGA0LDQt9GA0LXRiNC10L3QuNC1INC' .
        '/0L7QtNC60LvRjtGH0LDRgtGMINC40LvQuCDRgdC+0LLQvNC10YnQsNGC0Ywg0LvRjtCx0L7QtSDQu9C40YbQtdC90LfQuNGA0L7QstCw0L3QvdC+0LUNCtC/0YDQvtC40LfQstC10LTQtdC90LjQtSDRgSDQv9GA0L7QuNC30LLQtdC00LXQvdC40LXQvCwg0LvQuNGG0LXQvdC30LjRgNC+0LLQsNC90L3Ri9C8INGB0L7Qs9C70LDRgdC90L4g0YLRgNC10YLRjNC10LkNCtCy0LXRgNGB0LjQuCDQo9C90LjQstC10YDRgdCw0LvRjNC90L7QuSDQvtCx0YnQtdGB0YLQstC10L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCBHTlUg0JDRhNGE0LXRgNC+INCyINC10LTQuNC90L7QtQ0K0LrQvtC80LHQuNC90LjRgNC+0LLQsNC90L3QvtC1INC/0YDQvtC40LfQstC10LTQtdC90LjQtSDQuCDQv9C10YDQtdC00LDQstCw0YLRjCDQv9C+0LvRg9GH0LXQvdC90L7QtSDQsiDRgNC10LfRg9C70YzRgtCw0YLQtQ0K0L/RgNC+0LjQt9Cy0LXQtNC10L3QuNC1LiDQo9GB0LvQvtCy0LjRjyDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuCDQsdGD0LTRg9GCINC/0YDQvtC00L7Qu9C20LDRgtGMDQrQtNC10LnRgdGC0LLQvtCy0LDRgtGMINCyINGC0L7QuSDRh9Cw0YHRgtC4LCDQutC+0YLQvtGA0LDRjyDQvdCw0YXQvtC00LjRgtGB0Y8g0L/QvtC0INC90LXQuSwg0L3QviDQuA0K0YHQv9C10Y' .
        'bQuNCw0LvRjNC90YvQvCDRgtGA0LXQsdC+0LLQsNC90LjRj9C8INCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QvtC5INC+0LHRidC10YHRgtCy0LXQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4IEdOVQ0K0JDRhNGE0LXRgNC+INGA0LDQt9C00LXQu9CwIDEzLCDQutCw0YHQsNGO0YnQuNC10YHRjyDQstC30LDQuNC80L7QtNC10LnRgdGC0LLQuNGPINGH0LXRgNC10Lcg0LrQvtC80L/RjNGO0YLQtdGA0L3Rg9GODQrRgdC10YLRjCwg0LHRg9C00YPRgiDQv9GA0LjQvNC10L3Rj9GC0YzRgdGPINC60L4g0LLRgdC10LzRgyDQvtCx0YrQtdC00LjQvdC10L3QvdC+0LzRgyDQv9GA0L7QuNC30LLQtdC00LXQvdC40Y4uPC9wPg0KPGgzPjE0LiDQn9C10YDQtdGB0LzQvtGC0YDQtdC90L3Ri9C1INCy0LXRgNGB0LjQuCDQlNCw0L3QvdC+0Lkg0LvQuNGG0LXQvdC30LjQuC48L2gzPg0KPHA+0KTQvtC90LQg0YHQstC+0LHQvtC00L3QvtCz0L4g0L/RgNC+0LPRgNCw0LzQvNC90L7Qs9C+INC+0LHQtdGB0L/QtdGH0LXQvdC40Y8g0LzQvtC20LXRgiDQv9GD0LHQu9C40LrQvtCy0LDRgtGMDQrQuNGB0L/RgNCw0LLQu9C10L3QvdGL0LUg0Lgv0LjQu9C4INC90L7QstGL0LUg0LLQtdGA0YHQuNC4INCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QvtC5INC+0LHRidC10YHRgtCy0LXQvdC90L7QuQ0K0' .
        'LvQuNGG0LXQvdC30LjQuCBHTlUg0LLRgNC10LzRjyDQvtGCINCy0YDQtdC80LXQvdC4LiDQotCw0LrQuNC1INC90L7QstGL0LUg0LLQtdGA0YHQuNC4INCx0YPQtNGD0YIg0YHRhdC+0LTQvdGLINC/0L4NCtC00YPRhdGDINGBINC90LDRgdGC0L7Rj9GJ0LXQuSDQstC10YDRgdC40LXQuSwg0L3QviDQvNC+0LPRg9GCINC+0YLQu9C40YfQsNGC0YzRgdGPINCyINC00LXRgtCw0LvRj9GFLA0K0L3QsNC/0YDQsNCy0LvQtdC90L3Ri9GFINC90LAg0L3QvtCy0YvQtSDQv9GA0L7QsdC70LXQvNGLINC4INC+0LHRgdGC0L7Rj9GC0LXQu9GM0YHRgtCy0LAuINCa0LDQttC00L7QuSDQstC10YDRgdC40LgNCtC/0YDQuNGB0LLQsNC40LLQsNC10YLRgdGPINGB0LLQvtC5INGB0L7QsdGB0YLQstC10L3QvdGL0Lkg0L3QvtC80LXRgC4g0JXRgdC70Lgg0LIg0J/RgNC+0LPRgNCw0LzQvNC1DQrRg9C60LDQt9GL0LLQsNC10YLRgdGPLCDRh9GC0L4g0LrQvtC90LrRgNC10YLQvdGL0Lkg0L3QvtC80LXRgCDQstC10YDRgdC40Lgg0KPQvdC40LLQtdGA0YHQsNC70YzQvdC+0LkNCtC+0LHRidC10YHRgtCy0LXQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4IEdOVSDigJzQuNC70Lgg0LvRjtCx0LDRjyDQsdC+0LvQtdC1INC/0L7Qt9C00L3Rj9GPINCy0LXRgNGB0LjRj+KAnQ0K0L/RgNC40LzQ' .
        'tdC90LjQvNCwINC6INC90LXQuSwg0YLQviDRgyDQstCw0YEg0LXRgdGC0Ywg0LLQvtC30LzQvtC20L3QvtGB0YLRjCDRgdC70LXQtNC+0LLQsNGC0Ywg0L7Qv9GA0LXQtNC10LvQtdC90LjRj9C8DQrQuCDRg9GB0LvQvtCy0LjRj9C8INC70LjQsdC+INCy0LXRgNGB0LjQuCDRg9C60LDQt9Cw0L3QvdC+0LPQviDQvdC+0LzQtdGA0LAsINC70LjQsdC+INC70Y7QsdC+0Lkg0L/QvtGB0LvQtdC00YPRjtGJ0LXQuQ0K0LLQtdGA0YHQuNC4LCDQvtC/0YPQsdC70LjQutC+0LLQsNC90L3QvtC5INCk0L7QvdC00L7QvCDRgdCy0L7QsdC+0LTQvdC+0LPQviDQv9GA0L7Qs9GA0LDQvNC80L3QvtCz0L4NCtC+0LHQtdGB0L/QtdGH0LXQvdC40Y8uINCV0YHQu9C4INCyINCf0YDQvtCz0YDQsNC80LzQtSDQvdC1INGD0LrQsNC30LDQvSDQvdC+0LzQtdGAINCy0LXRgNGB0LjQuA0K0KPQvdC40LLQtdGA0YHQsNC70YzQvdC+0Lkg0L7QsdGJ0LXRgdGC0LLQtdC90L3QvtC5INC70LjRhtC10L3Qt9C40LggR05VLCDRgtC+INCy0Ysg0LzQvtC20LXRgtC1INCy0YvQsdGA0LDRgtGMDQrQu9GO0LHRg9GOINCy0LXRgNGB0LjRjiwg0LrQvtCz0LTQsC3Qu9C40LHQviDQvtC/0YPQsdC70LjQutC+0LLQsNC90L3Rg9GOINCk0L7QvdC00L7QvCDRgdCy0L7QsdC+0LTQvdC+0LPQvg0K0L/RgNC+0LP' .
        'RgNCw0LzQvNC90L7Qs9C+INC+0LHQtdGB0L/QtdGH0LXQvdC40Y8uPC9wPg0KPHA+0JXRgdC70Lgg0J/RgNC+0LPRgNCw0LzQvNCwINGD0YLQvtGH0L3Rj9C10YIsINGH0YLQviDRg9C/0L7Qu9C90L7QvNC+0YfQtdC90L3Ri9C5INC/0YDQtdC00YHRgtCw0LLQuNGC0LXQu9GMDQrQvNC+0LbQtdGCINGA0LXRiNCw0YLRjCDQutCw0LrQsNGPINC40Lcg0LHRg9C00YPRidC40YUg0LLQtdGA0YHQuNC5INCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QvtC5INC+0LHRidC10YHRgtCy0LXQvdC90L7QuQ0K0LvQuNGG0LXQvdC30LjQuCBHTlUg0LzQvtC20LXRgiDQsdGL0YLRjCDQuNGB0L/QvtC70YzQt9C+0LLQsNC90LAsINC/0YPQsdC70LjRh9C90L7QtSDQt9Cw0Y/QstC70LXQvdC40LUg0Y3RgtC+0LPQvg0K0L/RgNC10LTRgdGC0LDQstC40YLQtdC70Y8g0L4g0L/RgNC40L3Rj9GC0LjQuCDQstC10YDRgdC40Lgg0L3QsCDQv9C+0YHRgtC+0Y/QvdC90L7QuSDQvtGB0L3QvtCy0LUg0LTQsNC10YIg0LLQsNC8DQrQv9GA0LDQstC+INCy0YvQsdGA0LDRgtGMINGN0YLRgyDQstC10YDRgdC40Y4g0LTQu9GPINCf0YDQvtCz0YDQsNC80LzRiy48L3A+DQo8cD7QodC70LXQtNGD0Y7RidC40LUg0LLQtdGA0YHQuNC4INC70LjRhtC10L3Qt9C40Lgg0LzQvtCz0YPRgiDQtNCw0LLQsNGC0Y' .
        'wg0LLQsNC8INC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LUg0LjQu9C4DQrQtNGA0YPQs9C40LUg0YDQsNC30YDQtdGI0LXQvdC40Y8uINCd0LXRgdC80L7RgtGA0Y8g0L3QsCDRjdGC0L4sINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdGL0LUg0L7QsdGP0LfQsNGC0LXQu9GM0YHRgtCy0LANCtC90LUg0LLQvtC30LvQsNCz0LDRjtGC0YHRjyDQvdCwINCw0LLRgtC+0YDQsCDQuNC70Lgg0L/RgNCw0LLQvtC+0LHQu9Cw0LTQsNGC0LXQu9GPINC60LDQuiDRgNC10LfRg9C70YzRgtCw0YIg0LLQsNGI0LXQs9C+DQrQstGL0LHQvtGA0LAg0YHQu9C10LTRg9GO0YnQuNGFINCy0LXRgNGB0LjQuS48L3A+DQo8aDM+MTUuINCe0YLQutCw0Lcg0L7RgiDQs9Cw0YDQsNC90YLQuNC5LjwvaDM+DQo8cD7QndCV0KIg0J3QmNCa0JDQmtCY0KUg0JPQkNCg0JDQndCi0JjQmSDQlNCb0K8g0J/QoNCe0JPQoNCQ0JzQnNCrINCU0J4g0KDQkNCc0J7Qmiwg0JTQntCf0KPQodCi0JjQnNCr0KUNCtCU0JXQmdCh0KLQktCj0K7QqdCY0Jwg0JfQkNCa0J7QndCe0JTQkNCi0JXQm9Cs0KHQotCS0J7QnC4g0JXQodCb0Jgg0JjQndCe0JUg0J3QlSDQo9Ch0KLQkNCd0J7QktCb0JXQndCeINCSDQrQn9CY0KHQrNCc0JXQndCd0J7QmSDQpNCe0KDQnNCVLCDQn9Cg0JDQktCe0J7QkdCb0JDQlNCQ0KLQl' .
        'dCb0Kwg0Jgv0JjQm9CYINCU0KDQo9CT0JjQlSDQodCi0J7QoNCe0J3Qqw0K0J/QoNCV0JTQntCh0KLQkNCS0JvQr9Cu0KIg0J/QoNCe0JPQoNCQ0JzQnNCjIMKr0JrQkNCaINCV0KHQotCswrssINCR0JXQlyDQmtCQ0JrQmNClINCb0JjQkdCeINCT0JDQoNCQ0J3QotCY0JkNCijQl9CQ0K/QktCb0JXQndCd0KvQpSDQmNCb0Jgg0J/QntCU0KDQkNCX0KPQnNCV0JLQkNCV0JzQq9ClKSwg0JLQmtCb0K7Qp9CQ0K8sINCd0J4sINCd0JUg0J7Qk9Cg0JDQndCY0KfQmNCS0JDQr9Ch0KwsDQrQn9Ce0JTQoNCQ0JfQo9Cc0JXQktCQ0JXQnNCr0JzQmCDQk9CQ0KDQkNCd0KLQmNCv0JzQmCDQotCe0JLQkNCg0J3QntCT0J4g0KHQntCh0KLQntCv0J3QmNCvINCf0KDQmCDQn9Cg0J7QlNCQ0JbQlSDQmA0K0JPQntCU0J3QntCh0KLQmCDQlNCb0K8g0J7Qn9Cg0JXQlNCV0JvQldCd0J3QntCT0J4g0J/QoNCY0JzQldCd0JXQndCY0K8uINCS0JXQodCsINCg0JjQodCaLCDQmtCQ0Jog0JIg0J7QotCd0J7QqNCV0J3QmNCYDQrQmtCQ0KfQldCh0KLQktCQLCDQotCQ0Jog0Jgg0J/QoNCe0JjQl9CS0J7QlNCY0KLQldCb0KzQndCe0KHQotCYINCf0KDQntCT0KDQkNCc0JzQqyDQktCrINCR0JXQoNCV0KLQlSDQndCQINCh0JXQkdCvLg0K0JXQodCb0Jgg0JIg0J/QoNCe0JPQoNCQ0JzQnNCVINCe' .
        '0JHQndCQ0KDQo9CW0JXQnSDQlNCV0KTQldCa0KIsINCS0Ksg0JHQldCg0JXQotCVINCd0JAg0KHQldCR0K8g0KHQotCe0JjQnNCe0KHQotCsDQrQndCV0J7QkdCl0J7QlNCY0JzQntCT0J4g0J7QkdCh0JvQo9CW0JjQktCQ0J3QmNCvLCDQn9Ce0KfQmNCd0JrQmCDQmNCb0Jgg0JjQodCf0KDQkNCS0JvQldCd0JjQry48L3A+DQo8aDM+MTYuINCe0LPRgNCw0L3QuNGH0LXQvdC40LUg0L7RgtCy0LXRgtGB0YLQstC10L3QvdC+0YHRgtC4LjwvaDM+DQo8cD7QndCYINCSINCa0J7QldCcINCh0JvQo9Cn0JDQlSwg0JXQodCb0Jgg0J3QlSDQotCg0JXQkdCj0JXQotCh0K8g0J/QoNCY0JzQldCd0JjQnNCr0Jwg0JfQkNCa0J7QndCe0Jwg0JjQm9CYDQrQn9CY0KHQrNCc0JXQndCd0KvQnCDQodCe0JPQm9CQ0KjQldCd0JjQldCcLCDQndCYINCe0JTQmNCdINCY0Jcg0J/QoNCQ0JLQntCe0JHQm9CQ0JTQkNCi0JXQm9CV0Jkg0JjQm9CYINCh0KLQntCg0J7QnSwNCtCY0JfQnNCV0J3Qr9CS0KjQmNClINCYL9CY0JvQmCDQn9CV0KDQldCU0JDQktCQ0JLQqNCY0KUg0J/QoNCe0JPQoNCQ0JzQnNCjLCDQmtCQ0Jog0JHQq9Cb0J4g0KDQkNCX0KDQldCo0JXQndCeINCS0KvQqNCVLA0K0J3QlSDQntCi0JLQldCi0KHQotCS0JXQndCV0J0g0JfQkCDQo9Cp0JXQoNCRLCDQktCa0JvQrtCn0JD' .
        'QryDQntCR0KnQmNCZLCDQmtCe0J3QmtCg0JXQotCd0KvQmSwg0KHQm9Cj0KfQkNCZ0J3Qq9CZDQrQmNCb0Jgg0J/QntCh0JvQldCU0J7QktCQ0JLQqNCY0Jkg0KPQqdCV0KDQkSwg0JLQq9Ci0JXQmtCQ0K7QqdCY0Jkg0JjQlyDQmNCh0J/QntCb0KzQl9Ce0JLQkNCd0JjQryDQmNCb0JgNCtCd0JXQktCe0JfQnNCe0JbQndCe0KHQotCYINCY0KHQn9Ce0JvQrNCX0J7QktCQ0J3QmNCvINCf0KDQntCT0KDQkNCc0JzQqyAo0JLQmtCb0K7Qp9CQ0K8sINCd0J4sINCd0JUNCtCe0JPQoNCQ0J3QmNCn0JjQktCQ0K/QodCsINCf0J7QotCV0KDQldCZINCU0JDQndCd0KvQpSDQmNCb0Jgg0J3QldCS0JXQoNCd0J7QmSDQntCR0KDQkNCR0J7QotCa0J7QmSDQlNCQ0J3QndCr0KUsINCY0JvQmA0K0J/QntCi0JXQoNCYLCDQo9Ch0KLQkNCd0J7QktCb0JXQndCd0KvQlSDQktCQ0JzQmCDQmNCb0Jgg0KLQoNCV0KLQrNCY0JzQmCDQm9CY0KbQkNCc0JgsINCY0JvQmCDQndCV0JLQntCX0JzQntCW0J3QntCh0KLQrA0K0J/QoNCe0JPQoNCQ0JzQnNCrINCg0JDQkdCe0KLQkNCi0Kwg0KEg0JTQoNCj0JPQmNCc0Jgg0J/QoNCe0JPQoNCQ0JzQnNCQ0JzQmCksINCU0JDQltCVINCSINCh0JvQo9Cn0JDQlSDQldCh0JvQmA0K0J/QoNCQ0JLQntCe0JHQm9CQ0JTQkNCi0JXQm9CsINCb0JjQkdCeIN' .
        'CU0KDQo9CT0JDQryDQodCi0J7QoNCe0J3QkCDQkdCr0JvQkCDQmNCX0JLQldCp0JXQndCQINCeINCS0J7Ql9Cc0J7QltCd0J7QodCi0JgNCtCi0JDQmtCe0JPQniDQo9Cp0JXQoNCR0JAuPC9wPg0KPGgzPjE3LiDQmNC90YLQtdGA0L/RgNC10YLQsNGG0LjRjyDRgNCw0LfQtNC10LvQvtCyIDE1INC4IDE2LjwvaDM+DQo8cD7QldGB0LvQuCDQvtGC0LrQsNC3INC+0YIg0LPQsNGA0LDQvdGC0LjQuSDQuCDQvtCz0YDQsNC90LjRh9C10L3QuNC1INC+0YLQstC10YLRgdGC0LLQtdC90L3QvtGB0YLQuCwNCtC/0YDQtdC00YHRgtCw0LLQu9C10L3QvdGL0LUg0LLRi9GI0LUsINC90LUg0LzQvtCz0YPRgiDQsdGL0YLRjCDQuNGB0L/QvtC70L3QtdC90Ysg0YHQvtCz0LvQsNGB0L3QviDQuNGFDQrRg9GB0LvQvtCy0LjRj9C8LCDRgtC+INGA0LDRgdGB0LzQsNGC0YDQuNCy0LDRjtGJ0LjQtSDRgdGD0LTRiyDQtNC+0LvQttC90Ysg0L/RgNC40LzQtdC90LjRgtGMINC80LXRgdGC0L3Ri9C5INC30LDQutC+0L0sDQrQutC+0YLQvtGA0YvQuSDQvdCw0LjQsdC+0LvQtdC1INC/0YDQuNCx0LvQuNC20LXQvSDQuiDQsNCx0YHQvtC70Y7RgtC90L7QvNGDINC+0YLQutCw0LfRgyDQvtGCINCy0YHQtdC5DQrQs9GA0LDQttC00LDQvdGB0LrQvtC5INC+0YLQstC10YLRgdGC0LLQtdC90L3Qv' .
        'tGB0YLQuCDQsiDRgdCy0Y/Qt9C4INGBINCf0YDQvtCz0YDQsNC80LzQvtC5LCDQtdGB0LvQuCDQs9Cw0YDQsNC90YLQuNGPDQrQuNC70Lgg0L/RgNC40L3Rj9GC0LjQtSDQvdCwINGB0LXQsdGPINC+0YLQstC10YLRgdGC0LLQtdC90L3QvtGB0YLQuCDQvdC1INGB0L7Qv9GA0L7QstC+0LbQtNCw0Y7RgiDQutC+0L/QuNGODQrQn9GA0L7Qs9GA0LDQvNC80Ysg0LfQsCDQv9C70LDRgtGDLjwvcD4NCjxoMj7QmtCe0J3QldCmINCj0KHQm9Ce0JLQmNCZPC9oMj4NCjxwPtCa0LDQuiDQv9GA0LjQvNC10L3QuNGC0Ywg0LTQsNC90L3Ri9C1INGD0YHQu9C+0LLQuNGPINC6INCy0LDRiNC40Lwg0L3QvtCy0YvQvCDQv9GA0L7Qs9GA0LDQvNC80LDQvDwvcD4NCjxwPtCV0YHQu9C4INCy0Ysg0YDQsNC30YDQsNCx0LDRgtGL0LLQsNC10YLQtSDQvdC+0LLRg9GOINC/0YDQvtCz0YDQsNC80LzRgyDQuCDRhdC+0YLQuNGC0LUsINGH0YLQvtCx0Ysg0L7QvdCwDQrQv9GA0LjQvdC10YHQu9CwINC80LDQutGB0LjQvNCw0LvRjNC90L4g0LLQvtC30LzQvtC20L3Rg9GOINC/0L7Qu9GM0LfRgyDQvtCx0YnQtdGB0YLQstGDLCDRgtC+INC70YPRh9GI0LjQuSDRgdC/0L7RgdC+0LENCtC00L7QsdC40YLRjNGB0Y8g0Y3RgtC+0LPQviDigJMg0YHQtNC10LvQsNGC0Ywg0LXQtSDRgdCy0L7QsdC+' .
        '0LTQvdGL0Lwg0L/RgNC+0LPRgNCw0LzQvNC90YvQvCDQvtCx0LXRgdC/0LXRh9C10L3QuNC10LwsDQrQutC+0YLQvtGA0YvQuSDQvNC+0LbQtdGCINC/0L7QstGC0L7RgNC90L4g0YDQsNGB0L/RgNC+0YHRgtGA0LDQvdGP0YLRjCDQuCDQuNC30LzQtdC90Y/RgtGMINGB0L7Qs9C70LDRgdC90L4g0LTQsNC90L3Ri9C8DQrRg9GB0LvQvtCy0LjRj9C8LjwvcD4NCjxwPtCn0YLQvtCx0Ysg0YHQtNC10LvQsNGC0Ywg0Y3RgtC+LCDQvdGD0LbQvdC+INC00L7QsdCw0LLQuNGC0Ywg0YHQu9C10LTRg9GO0YnQuNC1INGD0LLQtdC00L7QvNC70LXQvdC40Y8g0LINCtC/0YDQvtCz0YDQsNC80LzRgy4g0JHQtdC30L7Qv9Cw0YHQvdC10LUg0LLRgdC10LPQviDQv9GA0LjRgdC+0LXQtNC40L3QuNGC0Ywg0LjRhSDQuiDQvdCw0YfQsNC70YMg0LrQsNC20LTQvtCz0L4NCtC40YHRhdC+0LTQvdC+0LPQviDRhNCw0LnQu9CwLCDRh9GC0L7QsdGLINC90LDQuNCx0L7Qu9C10LUg0Y3RhNGE0LXQutGC0LjQstC90L4g0LfQsNGP0LLQuNGC0Ywg0L7QsSDQvtGC0YHRg9GC0YHRgtCy0LjQuA0K0LPQsNGA0LDQvdGC0LjQuSwg0Lgg0LrQsNC20LTRi9C5INGE0LDQudC7INC00L7Qu9C20LXQvSDRgdC+0LTQtdGA0LbQsNGC0YwsINC/0L4g0LrRgNCw0LnQvdC10Lkg0LzQtdGA0LUsDQrigJzQsNC' .
        'y0YLQvtGA0YHQutC+0LUg0L/RgNCw0LLQvuKAnSDQuCDQv9C+0Y/RgdC90LXQvdC40LUsINCz0LTQtSDQvdCw0LnRgtC4INC/0L7Qu9C90YvQuSDRgtC10LrRgdGCDQrRg9Cy0LXQtNC+0LzQu9C10L3QuNGPLjwvcD4NCjxwcmU+Jmx0O9Ce0LTQvdCwINGB0YLRgNC+0YfQutCwINC00LvRjyDQvdCw0LfQstCw0L3QuNGPINC/0YDQvtCz0YDQsNC80LzRiyDQuCDQutGA0LDRgtC60L7Qs9C+INC+0L/QuNGB0LDQvdC40Y8g0YLQvtCz0L4sINGH0YLQviDQvtC90LAg0LTQtdC70LDQtdGCLiZndDsNCkNvcHlyaWdodCAoQykgJmx0O9Cz0L7QtCZndDsgJmx0O9C40LzRjyDQsNCy0YLQvtGA0LAmZ3Q7DQoNClRoaXMgcHJvZ3JhbSBpcyBmcmVlIHNvZnR3YXJlOiB5b3UgY2FuIHJlZGlzdHJpYnV0ZSBpdCBhbmQvb3IgbW9kaWZ5DQppdCB1bmRlciB0aGUgdGVybXMgb2YgdGhlIEdOVSBHZW5lcmFsIFB1YmxpYyBMaWNlbnNlIGFzIHB1Ymxpc2hlZCBieQ0KdGhlIEZyZWUgU29mdHdhcmUgRm91bmRhdGlvbiwgZWl0aGVyIHZlcnNpb24gMyBvZiB0aGUgTGljZW5zZSwgb3INCihhdCB5b3VyIG9wdGlvbikgYW55IGxhdGVyIHZlcnNpb24uDQoNClRoaXMgcHJvZ3JhbSBpcyBkaXN0cmlidXRlZCBpbiB0aGUgaG9wZSB0aGF0IGl0IHdpbGwgYmUgdXNlZnVsLA0KYnV0IFdJVEhPVVQgQU' .
        '5ZIFdBUlJBTlRZOyB3aXRob3V0IGV2ZW4gdGhlIGltcGxpZWQgd2FycmFudHkgb2YNCk1FUkNIQU5UQUJJTElUWSBvciBGSVRORVNTIEZPUiBBIFBBUlRJQ1VMQVIgUFVSUE9TRS4gIFNlZSB0aGUNCkdOVSBHZW5lcmFsIFB1YmxpYyBMaWNlbnNlIGZvciBtb3JlIGRldGFpbHMuDQoNCllvdSBzaG91bGQgaGF2ZSByZWNlaXZlZCBhIGNvcHkgb2YgdGhlIEdOVSBHZW5lcmFsIFB1YmxpYyBMaWNlbnNlDQphbG9uZyB3aXRoIHRoaXMgcHJvZ3JhbS4gIElmIG5vdCwgc2VlIGh0dHA6Ly93d3cuZ251Lm9yZy9saWNlbnNlcy8NCjwvcHJlPg0KPHA+0KLQsNC60LbQtSDQtNC+0LHQsNCy0YzRgtC1INC40L3RhNC+0YDQvNCw0YbQuNGOINC+INGC0L7QvCwg0LrQsNC6INGB0LLRj9C30LDRgtGM0YHRjyDRgSDQstCw0LzQuCDQv9C+DQrRjdC70LXQutGC0YDQvtC90L3QvtC5INC4INC+0LHRi9GH0L3QvtC5INC/0L7Rh9GC0LUuPC9wPg0KPHA+0JXRgdC70Lgg0L/RgNC+0LPRgNCw0LzQvNCwINCy0LfQsNC40LzQvtC00LXQudGB0YLQstGD0LXRgiDRgSDQv9C+0LvRjNC30L7QstCw0YLQtdC70LXQvCDQv9GA0Lgg0L/QvtC80L7RidC4DQrRgtC10YDQvNC40L3QsNC70LAsINGB0LTQtdC70LDQudGC0LUg0YLQsNC6LCDRh9GC0L7QsdGLINC+0L3QsCDQstGL0LLQvtC00LjQu9CwINC60' .
        'YDQsNGC0LrQvtC1INGB0L7QvtCx0YnQtdC90LjQtQ0K0L3QsNC/0L7QtNC+0LHQuNC1INC90LjQttC10YHQu9C10LTRg9GO0YnQtdCz0L4g0L/RgNC4INC30LDQv9GD0YHQutC1INCyINC40L3RgtC10YDQsNC60YLQuNCy0L3QvtC8INGA0LXQttC40LzQtTo8L3A+DQo8cHJlPiZsdDvQvdCw0LfQstCw0L3QuNC1INC/0YDQvtCz0YDQsNC80LzRiyZndDsgQ29weXJpZ2h0IChDKSAmbHQ70LPQvtC0Jmd0OyAmbHQ70LjQvNGPINCw0LLRgtC+0YDQsCZndDsNClRoaXMgcHJvZ3JhbSBjb21lcyB3aXRoIEFCU09MVVRFTFkgTk8gV0FSUkFOVFk7IGZvciBkZXRhaWxzIHR5cGUgInNob3cgdyIuIA0KVGhpcyBpcyBmcmVlIHNvZnR3YXJlLCBhbmQgeW91IGFyZSB3ZWxjb21lIHRvIHJlZGlzdHJpYnV0ZSBpdCB1bmRlciANCmNlcnRhaW4gY29uZGl0aW9uczsgdHlwZSAic2hvdyBjIiBmb3IgZGV0YWlscy4NCjwvcHJlPg0KPHA+0JPQuNC/0L7RgtC10YLQuNGH0LXRgdC60LjQtSDQutC+0LzQsNC90LTRiyAnc2hvdyB3JyDQuCAnc2hvdyBjJyDQtNC+0LvQttC90YsNCtC/0L7QutCw0LfRi9Cy0LDRgtGMINGB0L7QvtGC0LLQtdGC0YHRgtCy0YPRjtGJ0LjQtSDRh9Cw0YHRgtC4INCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QvtC5INC+0LHRidC10YHRgtCy0LXQvdC90L7QuQ0K0LvQuNGG' .
        '0LXQvdC30LjQuC4g0JrQvtC90LXRh9C90L4sINC60L7QvNCw0L3QtNGLINCy0LDRiNC10Lkg0L/RgNC+0LPRgNCw0LzQvNGLINC80L7Qs9GD0YIg0LHRi9GC0Ywg0YDQsNC30L3Ri9C80LgsDQrQv9C+0Y3RgtC+0LzRgyDQsiDRgdC70YPRh9Cw0LUg0LPRgNCw0YTQuNGH0LXRgdC60L7Qs9C+INC40L3RgtC10YDRhNC10LnRgdCwLCDQstGLINC80L7QttC10YLQtSDQuNGB0L/QvtC70YzQt9C+0LLQsNGC0YwNCtC00LjQsNC70L7Qs9C+0LLQvtC1INC+0LrQvdC+IOKAnNCeINC/0YDQvtCz0YDQsNC80LzQteKAnS48L3A+DQo8cD7QotCw0LrQttC1INC90LXQvtCx0YXQvtC00LjQvNC+LCDRh9GC0L7QsdGLINCy0LDRiCDRgNCw0LHQvtGC0L7QtNCw0YLQtdC70YwgKNC10YHQu9C4INCy0Ysg0YDQsNCx0L7RgtCw0LXRgtC1DQrQv9GA0L7Qs9GA0LDQvNC80LjRgdGC0L7QvCkg0LjQu9C4INCy0LDRiNC1INGD0YfQtdCx0L3QvtC1INC30LDQstC10LTQtdC90LjQtSwg0LXRgdC70Lgg0YLQsNC60L7QstC+0LUg0LjQvNC10LXRgtGB0Y8sDQrQv9C+0LTQv9C40YHQsNC70Lgg4oCc0L7RgtC60LDQtyDQvtGCINC40LzRg9GJ0LXRgdGC0LLQtdC90L3Ri9GFINC/0YDQsNCy4oCdINC90LAg0Y3RgtGDINC/0YDQvtCz0YDQsNC80LzRgywg0LXRgdC70LgNCtGN0YLQviDQvdC10L7QsdG' .
        'F0L7QtNC40LzQvi48YnI+DQrQlNC70Y8g0L/QvtC70YPRh9C10L3QuNGPINC00L7Qv9C+0LvQvdC40YLQtdC70YzQvdC+0Lkg0LjQvdGE0L7RgNC80LDRhtC40Lgg0L/QviDRjdGC0L7QvNGDINCy0L7Qv9GA0L7RgdGDLCDQuCwg0LrQsNC6DQrQv9GA0LjQvNC10L3Rj9GC0Ywg0Lgg0YHQu9C10LTQvtCy0LDRgtGMINCj0L3QuNCy0LXRgNGB0LDQu9GM0L3QvtC5INC+0LHRidC10YHRgtCy0LXQvdC90L7QuSDQu9C40YbQtdC90LfQuNC4IEdOVSwNCtGB0LzQvtGC0YDQuNGC0LUg0LfQtNC10YHRjCAtICZsdDs8YSBocmVmPSJodHRwOi8vd3d3LmdudS5vcmcvbGljZW5zZXMvIj5odHRwOi8vd3d3LmdudS5vcmcvbGljZW5zZXMvPC9hPiZndDs8L3A+DQo8cD7Qo9C90LjQstC10YDRgdCw0LvRjNC90LDRjyDQvtCx0YnQtdGB0YLQstC10L3QvdCw0Y8g0LvQuNGG0LXQvdC30LjRjyBHTlUg0L3QtSDQv9C+0LfQstC+0LvRj9C10YIg0LLQutC70Y7Rh9Cw0YLRjA0K0LLQsNGI0YMg0L/RgNC+0LPRgNCw0LzQvNGDINCyINC90LXRgdCy0L7QsdC+0LTQvdGL0LUuINCV0YHQu9C4INCS0Ysg0YXQvtGC0LjRgtC1INGN0YLQviDRgdC00LXQu9Cw0YLRjCwNCtC40YHQv9C+0LvRjNC30YPQudGC0LUg0KPQvdC40LLQtdGA0YHQsNC70YzQvdGD0Y4g0L7QsdGJ0LXRgdGC0LLQtdC90L3Rg9' .
        'GOINC70LjRhtC10L3Qt9C40Y4g0L7Qs9GA0LDQvdC40YfQtdC90L3QvtCz0L4NCtC/0YDQuNC80LXQvdC10L3QuNGPIEdOVSAoR05VIExlc3NlciBHZW5lcmFsIFB1YmxpYyBMaWNlbnNlLCBHTlUgTEdQTCkNCtCy0LzQtdGB0YLQviDRjdGC0L7QuSDQu9C40YbQtdC90LfQuNC4LCDQvdC+LCDQv9C+0LbQsNC70YPQudGB0YLQsCwg0L/RgNC+0YfQuNGC0LDQudGC0LUg0YHQvdCw0YfQsNC70LAg0LfQtNC10YHRjCAtDQombHQ7PGEgaHJlZj0iaHR0cDovL3d3dy5nbnUub3JnL3BoaWxvc29waHkvd2h5LW5vdC1sZ3BsLmh0bWwiPmh0dHA6Ly93d3cuZ251Lm9yZy9waGlsb3NvcGh5L3doeS1ub3QtbGdwbC5odG1sPC9hPiZndDs8L3A+';
    $license = base64_decode($license);
    $output .= <<<HTML
                <table class="form-table one-col">
                    <tbody>
                        <tr>
                            <td colspan="2"><div class="terms">{$license}</div></td>
                        </tr>
                        <tr>
                            <td><div class="form-buttons"><button id="submit_btn" class="default-button" type="submit">ПРОДОЛЖИТЬ</button></div></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="step" value='{$step}'/>
HTML;

} elseif ((int)$_GET['step'] == 2) {

    $cfg_file = INSTALLER_CONFIG_ABS_FILE;
    if (!empty($cfg_file) && is_writeable($cfg_file)) {
        $api_oc_abs_path              = defined('API_OC_ABS_PATH')              ? API_OC_ABS_PATH                                 : '';
        $api_abs_path                 = defined('API_ABS_PATH')                 ? API_ABS_PATH                                    : '';
        $api_base64_encode            = defined('API_BASE64_ENCODE')            ? (API_BASE64_ENCODE            ? 'checked' : '') : '';
        $api_debug_mode               = defined('API_DEBUG_MODE')               ? (API_DEBUG_MODE               ? 'checked' : '') : '';
        $api_full_url                 = defined('API_FULL_URL')                 ? (API_FULL_URL                 ? 'checked' : '') : '';
        $api_check_device_id          = defined('API_CHECK_DEVICE_ID')          ? (API_CHECK_DEVICE_ID          ? 'checked' : '') : '';
        $api_collection_max_size      = defined('API_COLLECTION_MAX_SIZE')      ? API_COLLECTION_MAX_SIZE                         : 1000;
        $api_temp_dir_name            = defined('API_TEMP_DIR_NAME')            ? API_TEMP_DIR_NAME                               : 'api_oc_temp';
        $api_session_table            = defined('API_SESSION_TABLE')            ? API_SESSION_TABLE                               : 'api_oc_session';
        $api_session_table_rows_limit = defined('API_SESSION_TABLE_ROWS_LIMIT') ? API_SESSION_TABLE_ROWS_LIMIT                    : 1000;
        $api_device_table             = defined('API_DEVICE_TABLE')             ? API_DEVICE_TABLE                                : 'api_oc_device';
        $api_session_lifetime         = defined('API_SESSION_LIFETIME')         ? API_SESSION_LIFETIME                            : 3600;
        $api_autogenerate_url_alias   = defined('API_AUTOGENERATE_URL_ALIAS')   ? (API_AUTOGENERATE_URL_ALIAS   ? 'checked' : '') : '';
        $api_autogenerate_product_sku = defined('API_AUTOGENERATE_PRODUCT_SKU') ? (API_AUTOGENERATE_PRODUCT_SKU ? 'checked' : '') : '';

        if (empty($api_oc_abs_path)) {
            $tmp_path = realpath('../../');
            if ($tmp_path && checkOSPath($tmp_path)) {
                $api_oc_abs_path = rtrim($tmp_path, "/\\") . '/';
            }
        }

        if (empty($api_abs_path)) {
            $api_abs_path = realpath('../');
            $api_abs_path = ($api_abs_path && checkAPIPath($api_abs_path)) ? rtrim($api_abs_path, "/\\") . '/' : '';
        }

        $API_DB_DRIVER   = defined('API_DB_DRIVER')   ? API_DB_DRIVER   : '';
        $API_DB_HOSTNAME = defined('API_DB_HOSTNAME') ? API_DB_HOSTNAME : '';
        $API_DB_USERNAME = defined('API_DB_USERNAME') ? API_DB_USERNAME : '';
        $API_DB_PASSWORD = defined('API_DB_PASSWORD') ? API_DB_PASSWORD : '';
        $API_DB_DATABASE = defined('API_DB_DATABASE') ? API_DB_DATABASE : '';
        $API_DB_PORT     = defined('API_DB_PORT')     ? API_DB_PORT     : '';
        $API_DB_PREFIX   = defined('API_DB_PREFIX')   ? API_DB_PREFIX   : '';

        $output .= <<<HTML
                <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="input_API_OC_ABS_PATH"><span>Абсолютный путь до корня OpenCart</span><span></span></label></td>
                            <td><input id="input_API_OC_ABS_PATH" type="text" name="API_OC_ABS_PATH" value="{$api_oc_abs_path}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_ABS_PATH"><span>Абсолютный путь до корня API</span><span></span></label></td>
                            <td><input id="input_API_ABS_PATH" type="text" name="API_ABS_PATH" value="{$api_abs_path}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_BASE64_ENCODE"><span>Кодировать ответ (по основанию 64/BASE64)</span><span>Кодировать ответ в Base64 для сжатия данных.</span></label></td>
                            <td><input id="input_API_BASE64_ENCODE" type="checkbox" name="API_BASE64_ENCODE" {$api_base64_encode} /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DEBUG_MODE"><span>Включить режим отладки</span><span>В режиме отладки будет доступна некоторая отладочная информация, которая поможет правильно настроить и оптимизировать API.</span></label></td>
                            <td><input id="input_API_DEBUG_MODE" type="checkbox" name="API_DEBUG_MODE" {$api_debug_mode} /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_FULL_URL"><span>Указывать полные URL для изображений и файлов</span><span>Дополнять, хранимые в базе данных, адреса изображений и файлов адресом магазина.</span></label></td>
                            <td><input id="input_API_FULL_URL" type="checkbox" name="API_FULL_URL" {$api_full_url} /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_CHECK_DEVICE_ID"><span>Проверять идентификатор устройства при авторизации</span><span>Предоставлять доступ к API только разрешенным устройствам.</span></label></td>
                            <td><input id="input_API_CHECK_DEVICE_ID" type="checkbox" name="API_CHECK_DEVICE_ID" {$api_check_device_id} /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_COLLECTION_MAX_SIZE"><span>Максимальный размер, возвращаемой с ответом, коллекции</span><span>Используется в случае, если в запросе не задан параметр «count».</span></label></td>
                            <td><input id="input_API_COLLECTION_MAX_SIZE" type="number" name="API_COLLECTION_MAX_SIZE" value="{$api_collection_max_size}" step="10" min="0" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_TEMP_DIR_NAME"><span>Имя временного каталога</span><span></span></label></td>
                            <td><input id="input_API_TEMP_DIR_NAME" type="text" name="API_TEMP_DIR_NAME" value="{$api_temp_dir_name}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_SESSION_TABLE"><span>Имя таблицы базы данных для хранения сессий пользователей</span><span>Будет создана таблица в базе данных OpenCart, в которой будет храниться история активности пользователей API.</span></label></td>
                            <td><input id="input_API_SESSION_TABLE" type="text" name="API_SESSION_TABLE" value="{$api_session_table}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_SESSION_TABLE_ROWS_LIMIT"><span>Максимальное количество записей в таблице сессий пользователей</span><span></span></label></td>
                            <td><input id="input_API_SESSION_TABLE_ROWS_LIMIT" type="number" name="API_SESSION_TABLE_ROWS_LIMIT" value="{$api_session_table_rows_limit}" step="10" min="0" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DEVICE_TABLE"><span>Имя таблицы базы данных для хранения правил доступа устройств</span><span>Будет создана таблица в базе данных OpenCart, в которой будут храниться правила доступа доверенных устройств.</span></label></td>
                            <td><input id="input_API_DEVICE_TABLE" type="text" name="API_DEVICE_TABLE" value="{$api_device_table}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_SESSION_LIFETIME"><span>Время неактивности пользователя</span><span>Количество секунд до истечения токена сессии.</span></label></td>
                            <td><input id="input_API_SESSION_LIFETIME" type="number" name="API_SESSION_LIFETIME" value="{$api_session_lifetime}" step="10" min="0" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_AUTOGENERATE_URL_ALIAS"><span>Автоматически генерировать альяс URL для SEO</span><span></span></label></td>
                            <td><input id="input_API_AUTOGENERATE_URL_ALIAS" type="checkbox" name="API_AUTOGENERATE_URL_ALIAS" {$api_autogenerate_url_alias} /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_AUTOGENERATE_PRODUCT_SKU"><span>Автоматически генерировать артикул (складской номер) товара</span><span></span></label></td>
                            <td><input id="input_API_AUTOGENERATE_PRODUCT_SKU" type="checkbox" name="API_AUTOGENERATE_PRODUCT_SKU" {$api_autogenerate_product_sku} /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="step" value='{$step}'/>
                <input type="hidden" name="API_DB_DRIVER" value='{$API_DB_DRIVER}'/>
                <input type="hidden" name="API_DB_HOSTNAME" value='{$API_DB_HOSTNAME}'/>
                <input type="hidden" name="API_DB_USERNAME" value='{$API_DB_USERNAME}'/>
                <input type="hidden" name="API_DB_PASSWORD" value='{$API_DB_PASSWORD}'/>
                <input type="hidden" name="API_DB_DATABASE" value='{$API_DB_DATABASE}'/>
                <input type="hidden" name="API_DB_PORT" value='{$API_DB_PORT}'/>
                <input type="hidden" name="API_DB_PREFIX" value='{$API_DB_PREFIX}'/>
                <div class="form-buttons"><button id="submit_btn" class="default-button" type="button" onclick="submitForm();">ДАЛЕЕ</button></div>
<script>
function setError(input) {
    var error = document.createElement('div');
    error.setAttribute('class', 'error');
    error.innerHTML = 'Целевые объекты не найдены по данному пути';
    input.parentElement.appendChild(error);
    input.focus();
    setTimeout(function() { error.parentElement.removeChild(error); }, 5000);
}
function submitForm() {
    var temp_dir_name = document.getElementById('input_API_TEMP_DIR_NAME');
    if (temp_dir_name.value.trim() == '') temp_dir_name.value = 'api_ocapi_temp';
    var session_table = document.getElementById('input_API_SESSION_TABLE');
    if (session_table.value.trim() == '') session_table.value = 'api_ocapi_session';
    var device_table = document.getElementById('input_API_DEVICE_TABLE');
    if (device_table.value.trim() == '') device_table.value = 'api_ocapi_device';
    
    var button = document.getElementById('submit_btn');
    if (button.hasAttribute('disabled')) return false;
    else button.setAttribute('disabled', 'true');
    var form = document.forms['installer_form'];
    var formData = new FormData(form);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './install.php?checkConfig', true);
    xhr.send(formData);
    xhr.onreadystatechange = function() {
        try { 
            if (xhr.readyState != 4) return;
            if (xhr.status != 200) {
                if (confirm("Невозможно проверить указанные пути. Продолжить без проверки?")) form.submit();
                else button.removeAttribute('disabled');
            } else {
                var results = this.responseText.split(':');
                var hasError = false;
                if (results[1] != '1') {
                    hasError = true;
                    setError(document.getElementById('input_API_ABS_PATH'));
                } 
                if (results[0] != '1') {
                    hasError = true;
                    setError(document.getElementById('input_API_OC_ABS_PATH'));
                } 
                if (hasError) { button.removeAttribute('disabled'); } 
                else { form.submit(); }
            }
        } catch(e) {
            console.warn('Exception:', e);
            if (confirm("Ошибка при проверке введенных данных. Продолжить без проверки?")) form.submit();
            else button.removeAttribute('disabled');
        }
    }
}
</script>
HTML;
    } else {
        $output .= 'Невозможно записать конфиг: "' . INSTALLER_CONFIG_ABS_FILE . '".';
    }

} elseif ((int)$_GET['step'] == 3) {

    $USE_OC_DB_DATA = 'false';
    if ($_POST['API_DB_DRIVER']      == $DB_DRIVER
        && $_POST['API_DB_HOSTNAME'] == $DB_HOSTNAME
        && $_POST['API_DB_USERNAME'] == $DB_USERNAME
        && $_POST['API_DB_PASSWORD'] == $DB_PASSWORD
        && $_POST['API_DB_DATABASE'] == $DB_DATABASE
        && $_POST['API_DB_PORT']     == $DB_PORT
        && $_POST['API_DB_PREFIX']   == $DB_PREFIX) {

        $api_db_driver   = $DB_DRIVER;
        $api_db_hostname = $DB_HOSTNAME;
        $api_db_username = $DB_USERNAME;
        $api_db_password = $DB_PASSWORD;
        $api_db_database = $DB_DATABASE;
        $api_db_port     = $DB_PORT;
        $api_db_prefix   = $DB_PREFIX;

        $USE_OC_DB_DATA = 'true';
    } elseif (!empty($_POST['API_DB_DRIVER'])
        && !empty($_POST['API_DB_HOSTNAME'])
        && !empty($_POST['API_DB_USERNAME'])
        && !empty($_POST['API_DB_DATABASE'])) {

        $api_db_driver   = $_POST['API_DB_DRIVER'];
        $api_db_hostname = $_POST['API_DB_HOSTNAME'];
        $api_db_username = $_POST['API_DB_USERNAME'];
        $api_db_password = $_POST['API_DB_PASSWORD'];
        $api_db_database = $_POST['API_DB_DATABASE'];
        $api_db_port     = $_POST['API_DB_PORT'];
        $api_db_prefix   = $_POST['API_DB_PREFIX'];

        $USE_OC_DB_DATA = 'false';
    } else {
        $api_db_driver   = $DB_DRIVER;
        $api_db_hostname = $DB_HOSTNAME;
        $api_db_username = $DB_USERNAME;
        $api_db_password = $DB_PASSWORD;
        $api_db_database = $DB_DATABASE;
        $api_db_port     = $DB_PORT;
        $api_db_prefix   = $DB_PREFIX;
    }

    try {
        include './app/db_connector.php';
    } catch (\Exception $e) {}
    $conn = new DBConnector('');
    $driver_options = '';
    foreach ($conn->drivers as $name => $value) {
        $driver_options .= "<option value=\"{$value}\"" . (($api_db_driver == $value) ? ' selected' : '') . ">{$name}</option>";
    }

    $output .= <<<HTML
                <table class="form-table">
                    <tbody>
                        <tr>
                            <td><label for="input_reuse_settings"><span>Использовать параметры OpenCart</span><span>Использовать параметры подключения к базе данных из файла конфигурации OpenCart.</span></label></td>
                            <td><input id="input_reuse_settings" type="checkbox" name="reuse_settings" onchange="reuseCheckedChanged(this.checked);" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_DRIVER"><span>Драйвер базы данных</span><span></span></label></td>
                            <td>
                                <select id="input_API_DB_DRIVER" name="API_DB_DRIVER">
                                    $driver_options
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_HOSTNAME"><span>Адрес сервера баз данных</span><span></span></label></td>
                            <td><input id="input_API_DB_HOSTNAME" type="text" name="API_DB_HOSTNAME" value="{$api_db_hostname}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_PORT"><span>Порт</span><span></span></label></td>
                            <td><input id="input_API_DB_PORT" type="text" name="API_DB_PORT" value="{$api_db_port}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_USERNAME"><span>Имя пользователя</span><span></span></label></td>
                            <td><input id="input_API_DB_USERNAME" type="text" name="API_DB_USERNAME" value="{$api_db_username}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_PASSWORD"><span>Пароль</span><span></span></label></td>
                            <td><input id="input_API_DB_PASSWORD" type="password" name="API_DB_PASSWORD" value="{$api_db_password}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_DATABASE"><span>Название базы данных</span><span></span></label></td>
                            <td><input id="input_API_DB_DATABASE" type="text" name="API_DB_DATABASE" value="{$api_db_database}" /></td>
                        </tr>
                        <tr>
                            <td><label for="input_API_DB_PREFIX"><span>Префикс таблиц</span><span></span></label></td>
                            <td><input id="input_API_DB_PREFIX" type="text" name="API_DB_PREFIX" value="{$api_db_prefix}" /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="step" value='{$step}'/>
                <input type="hidden" name="CONFIG" value='{$CONFIG}'/>
                <input type="hidden" name="DB_DRIVER" value='{$DB_DRIVER}'/>
                <input type="hidden" name="DB_HOSTNAME" value='{$DB_HOSTNAME}'/>
                <input type="hidden" name="DB_USERNAME" value='{$DB_USERNAME}'/>
                <input type="hidden" name="DB_PASSWORD" value='{$DB_PASSWORD}'/>
                <input type="hidden" name="DB_DATABASE" value='{$DB_DATABASE}'/>
                <input type="hidden" name="DB_PORT" value='{$DB_PORT}'/>
                <input type="hidden" name="DB_PREFIX" value='{$DB_PREFIX}'/>
                <input type="hidden" name="API_SESSION_TABLE" value='{$API_SESSION_TABLE}'/>
                <input type="hidden" name="API_DEVICE_TABLE" value='{$API_DEVICE_TABLE}'/>
                <div class="form-buttons"><button id="submit_btn" class="default-button" type="button" onclick="submitForm();">ДАЛЕЕ</button></div>
<script>
var db_driver = document.getElementById('input_API_DB_DRIVER');
var db_hostname = document.getElementById('input_API_DB_HOSTNAME');
var db_username = document.getElementById('input_API_DB_USERNAME');
var db_password = document.getElementById('input_API_DB_PASSWORD');
var db_database = document.getElementById('input_API_DB_DATABASE');
var db_port = document.getElementById('input_API_DB_PORT');
var db_prefix = document.getElementById('input_API_DB_PREFIX');
function reuseCheckedChanged(checked) {
    if (checked) {
        db_driver  .setAttribute('disabled', 'true');
        db_hostname.setAttribute('disabled', 'true');
        db_username.setAttribute('disabled', 'true');
        db_password.setAttribute('disabled', 'true');
        db_database.setAttribute('disabled', 'true');
        db_port    .setAttribute('disabled', 'true');
        db_prefix  .setAttribute('disabled', 'true');
        db_driver  .value = '{$DB_DRIVER}';
        db_hostname.value = '{$DB_HOSTNAME}';
        db_username.value = '{$DB_USERNAME}';
        db_password.value = '{$DB_PASSWORD}';
        db_database.value = '{$DB_DATABASE}';
        db_port    .value = '{$DB_PORT}';
        db_prefix  .value = '{$DB_PREFIX}';
    } else {
        db_driver  .removeAttribute('disabled');
        db_hostname.removeAttribute('disabled');
        db_username.removeAttribute('disabled');
        db_password.removeAttribute('disabled');
        db_database.removeAttribute('disabled');
        db_port    .removeAttribute('disabled');
        db_prefix  .removeAttribute('disabled');
    }
}
if ({$USE_OC_DB_DATA}) document.getElementById('input_reuse_settings').click();
function setError(input) {
    var error = document.createElement('div');
    error.setAttribute('class', 'error');
    error.innerHTML = 'Поле должно быть заполнено';
    input.parentElement.appendChild(error);
    input.focus();
    setTimeout(function() { error.parentElement.removeChild(error); }, 5000);
}
function validateForm() {
    var failure = false;
    if (db_database.value == '') { setError(db_database); failure = true; }
    if (db_username.value == '') { setError(db_username); failure = true; }
    if (db_port.value == '') { setError(db_port); failure = true; }
    if (db_hostname.value == '') { setError(db_hostname); failure = true; }
    return !failure;
}
var tryCount = 0;
function submitForm() {
    if (validateForm()) {
        var button = document.getElementById('submit_btn');
        if (button.hasAttribute('disabled')) return false;
        else button.setAttribute('disabled', 'true');
        var form = document.forms['installer_form'];
        var formDisabled = document.getElementById('input_reuse_settings').checked;
        reuseCheckedChanged(false);
        var formData = new FormData(form);
        if (formDisabled) reuseCheckedChanged(true);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', './install.php?checkDb', true);
        xhr.send(formData);
        xhr.onreadystatechange = function() {
            try { 
                if (xhr.readyState != 4) return;
                var hasError = false;
                var showError = function() {
                    tryCount++;
                    hasError = true;
                    var errorMsg = 'Невозможно соединиться с базой данных. Проверьте введенные данные.';
                    var error = document.createElement('div');
                    error.setAttribute('class', 'error error-header');
                    error.innerHTML = errorMsg;
                    form.insertBefore(error, form.children[0]);
                    error.scrollIntoView();
                    setTimeout(function() { form.removeChild(error); }, 5000);
                    button.removeAttribute('disabled');
                };
                if (xhr.status != 200) {
                    if (tryCount < 2) { showError(); } 
                    else { throw new Error('Несколько неудачных попыток установить соединение с базой данных. Хотите продолжить без проверки соединения?'); }
                } else {
                    if (this.responseText != '1') { showError(); } 
                    if (!hasError) {
                        reuseCheckedChanged(false);
                        form.submit();
                    }
                }
            } catch(e) {
                console.warn('Exception:', e);
                if (confirm("Ошибка при проверке введенных данных. Продолжить без проверки?")) {
                    reuseCheckedChanged(false);
                    form.submit();
                } else button.removeAttribute('disabled');
            }
        }
    }
}
</script>
HTML;

} elseif ((int)$_GET['step'] == 4) {

    $db = getDB(API_DB_DRIVER, API_DB_HOSTNAME, API_DB_USERNAME, API_DB_PASSWORD, API_DB_DATABASE, API_DB_PORT, $API_DB_PREFIX);
    $get_devices_query = $db->query("SELECT * FROM " . API_DB_PREFIX . $_POST['API_DEVICE_TABLE']);
    $num = 0;
    $rows = '';
    if ($get_devices_query['num_rows'] > 0) {
        foreach ($get_devices_query['rows'] as $row) {
            $checked = ((int)$row['status']) ? 'checked' : '';
            $rows .= <<<HTML
                        <tr id="row_{$num}">
                            <td><input type="text" maxlength="255" name="devices[{$num}][device_id]" value="{$row['device_id']}" /></td>
                            <td><input type="text" name="devices[{$num}][description]" value="{$row['description']}" /></td>
                            <td><input type="checkbox" name="devices[{$num}][status]" {$checked} /></td>
                            <td><a href="javascript:removeRow('row_{$num}');"><img src="{$IMAGES['remove']}" width="24" height="24" title="Удалить" alt="Удалить"/></a></td>
                        </tr>
HTML;
            $num++;
        }
    }
    $output .= <<<HTML
                <!--<div class="line right"><label for="input_API_CHECK_DEVICE_ID"><span>Проверять идентификатор устройства при авторизации</span><span></span></label><input id="input_API_CHECK_DEVICE_ID" type="checkbox" name="API_CHECK_DEVICE_ID" onchange="checkDeviceIdChanged(this.checked);" /></div>-->
                <table class="form-table form-table-devices">
                    <thead>
                        <tr>
                            <th>Идентификатор устройства</th>
                            <th>Комментарий</th>
                            <th>Включено</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="rows_container">
                        $rows
                    </tbody>
                    <tfoot>
                        <tr><td class="form-buttons" colspan="4"><button class="default-button add-button" type="button" onclick="addRow();">ДОБАВИТЬ</button></td></tr>
                    </tfoot>
                </table>
                <input type="hidden" name="step" value='{$step}'/>
                <input type="hidden" name="config_write_success" value='{$config_write_success}'/>
                <input type="hidden" name="session_table_created_success" value='{$session_table_created_success}'/>
                <input type="hidden" name="device_table_created_success" value='{$device_table_created_success}'/>
                <div class="form-buttons"><button id="submit_btn" class="default-button" type="submit">ГОТОВО!</button></div>
<script>
var num = {$num};
var rowsContainer = document.getElementById('rows_container');
function removeRow(id) {
    rowsContainer.removeChild(document.getElementById(id));
}
function addRow() {
    var row = document.createElement('tr');
    row.id = 'row_' + num;
    row.innerHTML = '                            <td><input type="text" maxlength="255" name="devices[' + num + '][device_id]" value="" /></td>' +
    '                            <td><input type="text" name="devices[' + num + '][description]" value="" /></td>' +
    '                            <td><input type="checkbox" name="devices[' + num + '][status]" checked /></td>' +
    '                            <td><a href="javascript:removeRow(\'row_' + num + '\');"><img src="{$IMAGES['remove']}" width="24" height="24" title="Удалить" alt="Удалить"/></a></td>';
    rowsContainer.appendChild(row);
}
</script>
HTML;

} elseif ((int)$_GET['step'] == 5) {

//    $devices_write_success = 0;

    $success = false;
    $points = '';
    $failure_img = "<img src=\"{$IMAGES['failure_small']}\">";
    $success_img = "<img src=\"{$IMAGES['success_small']}\">";
    $image = ($_POST['config_write_success']) ? $success_img : $failure_img;
    $points .= "<div>Запись файла конфигурации..................{$image}</div>";
    $image = ($_POST['session_table_created_success'] && $_POST['device_table_created_success']) ? $success_img : $failure_img;
    $points .= "<div>Соединение с базой данных..................{$image}</div>";
    $image = ($devices_write_success) ? $success_img : $failure_img;
    $points .= "<div>Добавление в БД доверенных устройств.......{$image}</div>";

    if ($_POST['config_write_success']
        && $_POST['session_table_created_success'] 
        && $_POST['device_table_created_success'] 
        && $devices_write_success) {
        $success = true;
    }
    
    if ($success) {
        $output .= <<<HTML
                <div class="complete">
                    <div><img src="{$IMAGES['success']}" /></div>
                    <div>ГОТОВО!</div>
                    <div>API настроен и готов к работе!</div>
                </div>
                <div class="complete-points">
                    $points
                </div>
                <div class="complete-alert">
                    <div><img src="{$IMAGES['exclamation']}">Не забудьте удалить установочный файл из каталога API!</div>
                </div>
HTML;
    } else {
        $output .= <<<HTML
                <div class="complete-failure">
                    <div><img src="{$IMAGES['failure']}" /></div>
                    <div>ОШИБКА!</div>
                    <div>В процессе установки возникли некоторые сложности :(</div>
                </div>
                <div class="complete-points">
                    $points
                </div>
                <div class="complete-alert">
                    <div><a href="./install.php?step=1">Попробуйте выполнить установку сначала</a></div>
                </div>
HTML;
    }
}
$output .= <<<HTML
            </form>
        </div>
    </div>
</div>
</body>
</html>
HTML;

// OUTPUT
header('Content-Type: text/html', true, 200);
echo $output;



function checkVersion() {
    if (!file_exists('../' . INSTALLER_VERSION)) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/ep.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app/app.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app/context.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app/db_connector.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app/drivers')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/app/drivers/mysqli.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/config')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/config/actions.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/config/config.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/config/includes.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/config/statuscode.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/model.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/auth.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/attribute.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/category.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/currency.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/file.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/filter.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/language.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/option.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/catalog/product.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/order/order.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/store/setting.php')) return false;
    if (!file_exists('../' . INSTALLER_VERSION . '/model/store/store.php')) return false;
//    if (!file_exists('../' . INSTALLER_VERSION . '/controller/controller.php')) return false;

    return true;
}

function checkOSPath($path) {
    if (file_exists($path)) {
        $path = rtrim($path, "/\\");
        $content = file_get_contents($path . '/config.php');
        $criteria_one = strpos($content, 'DIR_APPLICATION');
        $criteria_two = strpos($content, 'DB_DRIVER');
        if ($criteria_one && $criteria_two) return true;
    }
    return false;
}

function checkAPIPath($path) {
    if (file_exists($path)) {
        $path = rtrim($path, "/\\");
        $content = file_get_contents($path . '/' . INSTALLER_VERSION . '/config/config.php');
        $criteria_one = strpos($content, 'API_API_VERSION');
        $criteria_two = strpos($content, 'API_BASE64_ENCODE');
        if ($criteria_one && $criteria_two) return true;
    }
    return false;
}


function getDB($driver, $hostname, $username, $password, $database, $port, $prefix) {
    try {
        include_once './app/db_connector.php';
    } catch (\Exception $e) {}
    
    if (!defined('API_DB_DRIVER'))   define('API_DB_DRIVER', $driver);
    if (!defined('API_DB_HOSTNAME')) define('API_DB_HOSTNAME', $hostname);
    if (!defined('API_DB_USERNAME')) define('API_DB_USERNAME', $username);
    if (!defined('API_DB_PASSWORD')) define('API_DB_PASSWORD', $password);
    if (!defined('API_DB_DATABASE')) define('API_DB_DATABASE', $database);
    if (!defined('API_DB_PORT'))     define('API_DB_PORT',     $port);
    if (!defined('API_DB_PREFIX'))   define('API_DB_PREFIX',   $prefix);

    $connector = new DBConnector($driver);
    try {
        return $connector->connect();
    } catch (\Exception $e) {
        return false;
    }
}


