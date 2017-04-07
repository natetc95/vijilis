import os, operator

dirs = [x[0] for x in os.walk(os.getcwd())]
output = dict()
output['folder'] = 0

print os.getcwd()
for d in dirs:
    files = os.listdir(d)
    for f in files:
        try: 
            if os.path.getmtime(d + '\\' + f) > 1472075920:
                m = f.split('.')
                if len(m) == 2 and m[0] != '':
                    num_lines = sum(1 for line in open(d + '\\' + f))
                    if m[1] == 'phps':
                        m[1] = 'php'
                    if m[1] not in output.keys():
                        output[m[1]] = num_lines
                    else:
                        output[m[1]] += num_lines
                else:
                    output['folder'] += 1
        except Exception as e:
            print e

sorted_x = sorted(output.items(), key=operator.itemgetter(1))
sorted_x.reverse()

print "Total Line Count:"
print "  " + str(sum(output.values()))

print "Line Counts By File Type:"
for i in sorted_x:
    print "  " + i[0] + ': ' + str(i[1])

raw_input("Press Enter To Continue!")
