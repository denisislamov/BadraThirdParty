import sys

file = open(sys.argv[1], 'r', encoding='utf-8')
file_out = open(sys.argv[2], 'w', encoding='utf-8')

def find(s, ch):
    return [i for i, ltr in enumerate(s) if ltr == ch]

for line in file:
    if line.find("thumburl") != -1 or line.find("preview url") != -1:
        print("****************************************")
        print("FOUND: " + line)

        line = line.replace("jpg_", "_")
        lastIndex = line.rfind('_')
        line = line[:lastIndex] + "~" + line[lastIndex+1:]
        line = line.replace("_", "")
        line = line.replace("~", "_")

        print("CHANGE TO: " + line)
        print("****************************************\n\n")

    file_out.write(line)

file.close()
file_out.close()
