import sys

file = open(sys.argv[1], 'r', encoding='utf-8')
file_out = open(sys.argv[2], 'w', encoding='utf-8')

def find_between(s, first, last):
    try:
        start = s.index(first) + len(first)
        end = s.index(last, start)
        return s[start:end]
    except ValueError:
        return ""


def find_between_r(s, first, last):
    try:
        start = s.rindex(first) + len(first)
        end = s.rindex(last, start)
        return s[start:end]
    except ValueError:
        return ""


def find(s, ch):
    return [i for i, ltr in enumerate(s) if ltr == ch]


pano_file = ""
for line in file:
    if line.find("@PanoFile") != -1:
        #print(line)
        pano_file = find_between_r(line, "/", "\"")
        pano_file = pano_file.replace(".png", "")
        pano_file = pano_file.replace(".jpg", "")
        pano_file = pano_file.replace("-3d", "_3d_")

        print("****************************************");
        print("True pano_file name found: '" + pano_file + "'\n")

    if pano_file and line.find("thumburl=") != -1:
        #print(line)
        thumburl_folder = find_between_r(line, "%/", "/")
        # print("thumburl_folder: " + thumburl_folder)
        print("FOUND: " + line)
        line = line.replace(thumburl_folder, pano_file)
        print("CHANGE TO: " + line)

    if pano_file and line.find("preview url=") != -1:
        preview_folder = find_between_r(line, "%/", "/preview")
        # print("preview_folder: " + preview_folder)
        # print("")
        print("FOUND: " + line)
        line = line.replace(preview_folder, pano_file)
        print("CHANGE TO: " + line)
        print("****************************************\n\n")
    file_out.write(line)

file.close()
file_out.close()
