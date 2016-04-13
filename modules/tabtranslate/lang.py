#!/usr/bin/python

# This python script generates the file lang.php based on the file
# db_settings_lite.sql. Replace the inner of the function getTables in
# tabtranslate.php with the contents of lang.php if there is an updated
# version of db_settings_lite.sql. 

import re
import sys


def GetLine(fp):
  line = fp.readline()
  return line.replace("NOW()", "$now")


def GetValue(fp, line):
  if line[0] == ')':
    return (None, line[1:])
  m = re.match('\s*(\'[^\']*\')?([^,)]*),?(.*)', line)
  if m:
    if m.group(1):
      return (m.group(1), m.group(3))
    if m.group(2):
      return (m.group(2), m.group(3))
  return (None, None)


def GetValuesList(fp, tableName, fieldStr, line):
  valuesList = []
  valuesDict = {}
  fields = fieldStr.replace("`", "").strip("()").split(", ")
  while True:
    values = []
    if not line:
      line = GetLine(fp)
    if re.match('\s*;', line):
      break
    m = re.match('\((.*)', line)
    if m:
      line = m.group(1)
      while True:
	(value, line) = GetValue(fp, line)
	if not value:
	  break
	if len(values) < len(fields) and fields[len(values)] == 'date_upd':
	  value = '$now';
	value = value.replace("\\r\\n", "[nl]");
	values.append(value)
    if tableName == 'lang':
      # id_lang as first index (lang table)
      valuesDict[values[0]] = values
      if values[0] == '1':
	valuesList.append(values)
    elif fields[0] == 'id_lang':
      # id_lang as first index
      valuesDict[values[1]] = values
      if values[0] == '1':
	valuesList.append(values)
    elif fields[1] == 'id_lang':
      # id_lang as second index
      valuesDict[values[0], values[1]] = values
      if values[1] == '1':
	valuesList.append(values)
    elif fields[2] == 'id_lang':
      # id_lang as third index
      valuesDict[values[0], values[2]] = values
      if values[2] == '1':
	valuesList.append(values)
    else:
      print fields
      raise Exception, "Can't handle this"
    # Next set
    m = re.match('\s*,\s*(.*)', line)
    if m:
      line = m.group(1)
  retValuesList = []

  if tableName == 'lang':
    firstI = 1
  elif fields[0] == 'id_lang':
    firstI = 1
  elif fields[1] == 'id_lang':
    firstI = 2
  elif fields[2] == 'id_lang':
    firstI = 3
  else:
    raise Exception, "Can't handle this" 

  langTrans = []
  for values in valuesList:
    i = firstI
    while len(langTrans) < len(values):
      langTrans.append('0');
    while i < len(values):
      if tableName == 'lang':
	if i in (1,):
	  langTrans[i] = '1'
      else:
	langTrans[i] = '1'
      i = i + 1

  for values in valuesList:
    id = values[0]
    i = firstI
    while i < len(values):
      if langTrans[i] == '1' and values[i] != "''":
	if tableName == 'order_state_lang' and i == 3:
	  # Don't translate e-mail template names
	  pass
	elif values[i] == 'NULL':
	  pass
	elif values[i] == '0':
	  pass
	elif values[i].isdigit():
	  pass
	elif values[i] == '$now':
	  pass
	else:
	  values[i] = '$this->l(' + values[i] + ', true)'
      i = i + 1
    retValuesList.append("array(" + ', '.join(values) + ")")

  return retValuesList, langTrans


if len(sys.argv) > 1:
  fp = open(sys.argv[1], "r");
  prefix = "PREFIX_";
else:
  fp = open("dump.sql", "r");
  prefix = "ps_";
if len(sys.argv) > 2:
  fa = open(sys.argv[2], "w");
else:
  fa = open("lang.php", "w");
fa.write("    $now = date('Y-m-d');\n");
fa.write("    $tables = array();\n\n");
tabLangCount = 0
while True:
  line = GetLine(fp)
  if not line:
    break
  m = re.match('INSERT\s+INTO\s+`?' + prefix + '(\w*lang)`?\s*(.*)\s+VALUES\s*(.*)', line)
  if m:
    print m.group(1)
    (valuesList, langTrans) = GetValuesList(fp, m.group(1), m.group(2), m.group(3))
    if m.group(1) == 'cms_lang':
      continue
    if len(valuesList) == 0:
      continue
    fa.write("    $table = new StdClass();\n");
    fa.write("    $table->name = '" + m.group(1) + "';\n")
    fa.write("    $table->fields = array" + m.group(2).replace("`", "'") + ";\n")
    fa.write("    $table->flags = array(" + ", ".join(langTrans) + ");\n");
    fa.write("    $table->data = array(\n      " + ",\n      ".join(valuesList) + ");\n");
    fa.write("    $tables[] = $table;\n\n");
fa.write("    return $tables;\n");
